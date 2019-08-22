<?php
namespace App\controllers;

class LoginController extends Controller
{
    public function showForm(){
        echo $this->view->render('/auth/login');
    }

    public function login(){
        try {
            $rememberDuration = null;

            if (isset($_POST['remember']) == 1) {
                // keep logged in for one year
                $rememberDuration = (int) (60 * 60 * 24 * 365.25);
            }

            $this->auth->login($_POST['email'], $_POST['password'], $rememberDuration);

            return header('Location: /');
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Wrong email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Wrong password');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }

    }

    public function logout(){
        try {
            $this->auth->logOutEverywhere();
            return header('Location: /');
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        }
    }
}