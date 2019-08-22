<?php

namespace App\Services;


use Delight\Auth\Auth;
use PDO;

class RegisterService
{
    private $pdo;
    private $notification;
    private $auth;

    public function __construct(PDO $pdo, Notification $notification, Auth $auth)
    {
        $this->pdo = $pdo;
        $this->notification = $notification;
        $this->auth = $auth;
    }

    public function make($email, $password, $username){
        $userId = $this->auth->register($email, $password, $username, function ($selector, $token) use ($email)  {
            $this->notification->changMail($email, $selector, $token);
        });
    }
}