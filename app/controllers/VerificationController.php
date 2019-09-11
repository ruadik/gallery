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

            flash()->success('Email address has been verified');
            return Header('Location: /login');
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            flash()->success('Invalid token');
            return Header('Location: /login');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            flash()->success('Token expired');
            return Header('Location: /login');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->success('Email address already exists');
            return Header('Location: /login');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->success('Too many requests');
            return Header('Location: /login');
        }

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