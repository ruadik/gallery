<?php
namespace App\controllers;

use App\Services\ImageManager;
use App\Services\Profile;
use League\Plates\Engine;

class ProfileController extends Controller
{
    private $profile;
    private $imageManager;

    public function __construct(Profile $profile, ImageManager $imageManager)
    {
        parent::__construct();
        $this->profile = $profile;
        $this->imageManager = $imageManager;

        if(!$this->auth->isLoggedIn()){redirect('/login');}
    }

    public function showInfo(){
        $user = $this->database->selectOne('users', 'id', $this->auth->getUserId());
        echo $this->view->render('profile/profile-info', compact('user'));
    }

    public function showSecurity(){
        echo $this->view->render('profile/profile-security');
    }

    public function postInfo(){
        try {
            $this->profile->changeInformation($_POST['username'], $_POST['email']);

            $user = $this->database->selectOne('users', 'id', $this->auth->getUserId());
            $filename = $this->imageManager->uploadImage($_FILES['image'], $user['image']);
            $this->database->update('users', $this->auth->getUserId(), ['image' => $filename]);

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