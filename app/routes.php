<?php
if( !session_id() ) @session_start();
use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;
use Intervention\Image\ImageManager;
use League\Plates\Engine;
use Delight\Auth\Auth;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    PDO::class  => function(){
        return new PDO('mysql:host=192.168.10.10; dbname=gallery; charset=utf8', 'homestead', 'secret');
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
    $r->addRoute('GET', '/', ['App\controllers\HomeController', 'index']);

    $r->addRoute('GET', '/upload', ['App\controllers\HomeController', 'upload']);
    $r->addRoute('POST', '/upload', ['App\controllers\HomeController', 'upload']);

    $r->addRoute('GET', '/register', ['App\controllers\RegistrationController', 'showForm']);
    $r->addRoute('POST', '/register', ['App\controllers\RegistrationController', 'register']);


    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
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