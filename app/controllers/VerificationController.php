<?php

namespace App\controllers;

use App\Services\Notification;

class VerificationController extends Controller
{
    private $notification;

    public function __construct(Notification $notification)
    {
        parent::__construct();
        $this->notification = $notification;
    }

    public function showForm(){
        echo $this->view->render('/auth/email-verification');
    }

    public function verification(){
        try {
            $this->auth->confirmEmail($_GET['selector'], $_GET['token']);

            echo 'Email address has been verified';
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('Email address already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
        return Header('Location: /login');
    }

    public function reConfirmation(){
        try {
            $this->auth->resendConfirmationForEmail($_POST['email'], function ($selector, $token) {
                $this->notification->changMail($_POST['email'], $selector, $token);
                flash()->success(['На Ваш емайл ' . $_POST['email'] . ' повторно был отправлен код подтверждения']);
                return header('Location: /login');
            });
        }
        catch (\Delight\Auth\ConfirmationRequestNotFound $e) {
            die('No earlier request found that could be re-sent');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('There have been too many requests -- try again later');
        }
    }
}