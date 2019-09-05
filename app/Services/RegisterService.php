<?php

namespace App\Services;


use App\controllers\Controller;
use Delight\Auth\Auth;
use PDO;

class RegisterService
{
    private $notification;
    private $auth;
    private $database;

    public function __construct(Notification $notification, Auth $auth, Database $database)
    {
        $this->notification = $notification;
        $this->auth = $auth;
        $this->database = $database;
    }

    public function make($email, $password, $username){
        $userId = $this->auth->register($email, $password, $username, function ($selector, $token) use ($email)  {
            $this->notification->changMail($email, $selector, $token);
        });

        $this->database->update('users', $userId, ['roles_mask'=> Roles::USER]);

        return $userId;

    }
}