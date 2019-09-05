<?php

namespace App\controllers\admin;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $users = $this->database->selectAll('users');
//        dd($users);
        echo $this->view->render('/admin/users/index', ['users' => $users]);
    }

}