<?php

namespace App\Services;


use Delight\Auth\Auth;
use PDO;

class RegisterService
{
    private $pdo;
    private $notification;
//    private $auth;

    public function __construct(PDO $pdo, Notification $notification)
    {
        $this->pdo = $pdo;
        $this->notification = $notification;
//        $this->auth = $auth;
    }

    public function make($email, $password, $username){
        $auth = new Auth($this->pdo);

        $userId = $auth->register($email, $password, $username, function ($selector, $token) use ($email, $username)  {
            $this->notification->changMail($email, $username, $selector, $token);
        });
    }
}