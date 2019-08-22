<?php

namespace App\controllers;

use App\Services\Database;
use App\Services\Roles;
use Delight\Auth\Auth;
use League\Plates\Engine;
use PDO;

class Controller
{
    protected $auth;
    protected $view;
    protected $database;

    public function __construct()
    {
        $this->auth = components(Auth::class);
        $this->view = components(Engine::class);
        $this->database = components(Database::class);
    }

    function checkForAccess()
    {
        if($this->auth->hasRole(Roles::USER)) { return redirect('/'); }
    }
}