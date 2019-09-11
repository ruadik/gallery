<?php
if( !session_id() ) @session_start();
use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Intervention\Image\ImageManager;
use League\Plates\Engine;
use Delight\Auth\Auth;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    PDO::class  => function(){
        return new PDO('mysql:host=192.168.10.10; dbname=gallery; charset=utf8', 'homestead', 'secret');
    },

    Auth::class   =>  function($container) {
        return new Auth($container->get('PDO'));
    },

    QueryFactory::class => function(){
        return new QueryFactory('mysql');
    },

    ImageManager::class => function(){
        return new ImageManager(array('driver' => 'imagick'));
    },

    Engine::class => function(){
        return new Engine('../app/views');
    }
]);



$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');

    $r->get('/', ['App\controllers\HomeController', 'index']);
    $r->get('/category/{id:\d+}', ['App\controllers\HomeController', 'category']);
    $r->get('/photos/{id:\d+}', ['App\controllers\PhotosController', 'show']);
    $r->get('/photos/{id:\d+}/user', ['App\controllers\HomeController', 'user']);
    $r->get('/download/{id:\d+}', ['App\controllers\PhotosController', 'download']);


    $r->get('/login', ['App\controllers\LoginController', 'showForm']);
    $r->post('/login', ['App\controllers\LoginController', 'login']);
    $r->get('/logout', ['App\controllers\LoginController', 'logout']);

    $r->get('/register', ['App\controllers\RegistrationController', 'showForm']);
    $r->post('/register', ['App\controllers\RegistrationController', 'register']);

    $r->get('/email_verification', ['App\controllers\VerificationController', 'showForm']);
    $r->get('/verify_email', ['App\controllers\VerificationController', 'verification']);
    $r->post('/re_verify_email', ['App\controllers\VerificationController', 'reConfirmation']);

    $r->get('/reset_password', ['App\controllers\PasswordResetController', 'showForm']);
    $r->post('/reset_password', ['App\controllers\PasswordResetController', 'password_reset']);
    $r->get('/reset_password/form', ['App\controllers\PasswordResetController', 'showResetForm']);
    $r->post('/reset_password/update', ['App\controllers\PasswordResetController', 'UpdatingPassword']);

    $r->get('/profile_info', ['App\controllers\ProfileController', 'showInfo']);
    $r->post('/profile_info', ['App\controllers\ProfileController', 'postInfo']);

    $r->get('/profile_security', ['App\controllers\ProfileController', 'showSecurity']);
    $r->post('/profile_security', ['App\controllers\ProfileController', 'postSecurity']);


    $r->get('/photos', ['App\controllers\PhotosController', 'index']);

    $r->get('/photos/create', ['App\controllers\PhotosController', 'create']);
    $r->post('/photos/store', ['App\controllers\PhotosController', 'store']);

    $r->get('/photos/{id:\d+}/edit', ['App\controllers\PhotosController', 'edit']);
    $r->post('/photos/{id:\d+}/update', ['App\controllers\PhotosController', 'update']);

    $r->get('/photos/{id:\d+}/delete', ['App\controllers\PhotosController', 'delete']);




    $r->addGroup('/admin/', function (RouteCollector $r) {
        $r->get('', ['App\controllers\admin\HomeController', 'index']);


        $r->get('photos', ['App\controllers\admin\PhotosController', 'index']);
        $r->get('photos/create', ['App\controllers\admin\PhotosController', 'create']);
        $r->post('photos/create', ['App\controllers\admin\PhotosController', 'store']);

        $r->get('photos/edit/{id:\d+}', ['App\controllers\admin\PhotosController', 'edit']);
        $r->post('photos/update/{id:\d+}', ['App\controllers\admin\PhotosController', 'update']);

        $r->get('photos/delete/{id:\d+}', ['App\controllers\admin\PhotosController', 'delete']);


        $r->get('categories', ['App\controllers\admin\CategoriesController', 'index']);
        $r->get('categories/create', ['App\controllers\admin\CategoriesController', 'create']);
        $r->post('categories/create', ['App\controllers\admin\CategoriesController', 'store']);

        $r->get('categories/edit/{id:\d+}', ['App\controllers\admin\CategoriesController', 'edit']);
        $r->post('categories/update/{id:\d+}', ['App\controllers\admin\CategoriesController', 'update']);

        $r->get('categories/delete/{id:\d+}', ['App\controllers\admin\CategoriesController', 'delete']);


        $r->get('users', ['App\controllers\admin\UsersController', 'index']);

        $r->get('users/create', ['App\controllers\admin\UsersController', 'create']);
        $r->post('users/store', ['App\controllers\admin\UsersController', 'store']);

        $r->get('users/edit/{id:\d+}', ['App\controllers\admin\UsersController', 'edit']);
        $r->post('users/update/{id:\d+}', ['App\controllers\admin\UsersController', 'update']);

        $r->get('users/delete/{id:\d+}', ['App\controllers\admin\UsersController', 'delete']);



    });

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo " ... 404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo " ... 405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

//        $container = new DI\Container();
        $container->call($handler, $vars);
        // ... call $handler with $vars
        break;
}