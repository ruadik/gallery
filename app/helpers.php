<?php

use App\Services\Database;
use App\Services\Roles;
use Delight\Auth\Auth;
use JasonGrimes\Paginator;

function paginator($paginator){
    include '../app/views/partials/paginator.php';
}

function getAllcategories(){
    global $container;
    $QueryFactory = $container->get('Aura\SqlQuery\QueryFactory');
    $PDO = $container->get('PDO');
    $database = new Database($PDO, $QueryFactory);
    return $database->selectAll('categories');
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