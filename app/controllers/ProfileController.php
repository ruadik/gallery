<?php
namespace App\controllers;

use App\Services\Profile;
use League\Plates\Engine;

class ProfileController extends Controller
{
    private $profile;

    public function __construct(Profile $profile)
    {
        parent::__construct();
        $this->profile = $profile;
        if(!$this->auth->isLoggedIn()){redirect('/login');}
    }

    public function showInfo(){
        $user = $this->database->selectOne('users', 'id', $this->auth->getUserId());
//        var_dump(compact('user')); exit();
        echo $this->view->render('profile/profile-info', compact('user'));
    }

    public function showSecurity(){
        echo $this->view->render('profile/profile-security');
    }

    public function postInfo(){
//        var_dump($_POST); exit();
        try {
            $this->profile->changeInformation($_POST['username'], $_POST['email']);
            flash()->success(['Профиль обновлен']);
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('Email address already exists');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Account not verified');
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
        return back();
    }

    public function postSecurity(){
        try {
            $this->auth->changePassword($_POST['oldPassword'], $_POST['newPassword']);
            flash()->success(['Password has been changed']);
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password(s)');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
        return back();
    }

}