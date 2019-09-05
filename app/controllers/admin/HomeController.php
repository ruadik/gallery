<?php


namespace App\controllers\admin;



class HomeController extends Controller
{
    public function index(){
        echo $this->view->render('/admin/dashboard');
    }
}