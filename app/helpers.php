<?php

use App\Services\Database;
use App\Services\ImageManager;
use App\Services\Roles;
use Delight\Auth\Auth;
use JasonGrimes\Paginator;

function paginator($paginator){
    include '../app/views/partials/paginator.php';
}

function getCategory($id)
{
    global $container;
    $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $pdo = $container->get('PDO');
    $database = new Database($pdo, $queryFactory);
    return $database->selectOne('categories', 'id', $id);
}

function getAllcategories(){
    global $container;
    $QueryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $PDO = $container->get('PDO');
    $database = new Database($PDO, $QueryFactory);
    return $database->selectAll('categories');
}

function getRole($key){
    return Roles::getRole($key);
}

function getVerification($key){
    if($key == 1){
        return 'Верифицирован';
    }else{
        return 'Не верефицирован';
    }
}

function config($field){
    $array = require '../app/config.php';
    return array_get($array, $field);
}

function abort($type)
{
    switch ($type) {
        case 404:
            $view = components(\League\Plates\Engine::class);
            echo $view->render('errors/404');exit;
            break;
    }
}

function getImage($image){
    $imageManager = new ImageManager();
    return $imageManager->getImage($image);
}

function uploadedDate($timestamp)
{
    return $date =  date('Y.m.d', '2019-08-07 00:00:00');
    var_dump($date);
}

function back()
{
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function dd($data){
    var_dump($data); exit();
};

function auth()
{
    global $container;
    return $container->get(Auth::class);
}

function components($name)
{
    global $container;
    return $container->get($name);
}

function redirect($path){
    header("Location: $path");
    exit();
}