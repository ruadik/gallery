<?php
namespace App\controllers;

use App\Services\Notification;

class PasswordResetController extends Controller
{
    private $notification;

    public function __construct(Notification $notification)
    {
        parent::__construct();
        $this->notification = $notification;
    }

    public function showForm(){
        echo $this->view->render('/auth/password_reset');
    }

    public function password_reset(){
        try {
            $this->auth->forgotPassword($_POST['email'], function ($selector, $token) {
                $this->notification->resetPassword($_POST['email'], $selector, $token);
            }, 600);

            flash()->success(['На Вашу почту ' . $_POST['email'] . 'выслана ссылка на смену пароля']);
            return Header('Location: /login');
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function showResetForm(){
        try {
            $this->auth->canResetPasswordOrThrow($_GET['selector'], $_GET['token']);
            echo $this->view->render('/auth/set-new-password', ['data'=> $_GET]);
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function UpdatingPassword(){
        try {
            $this->auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['password']);
            flash()->success(['Пароль успешно изменен']);
            echo $this->view->render('/Auth/login');
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }
}