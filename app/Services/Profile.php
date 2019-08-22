<?php


namespace App\Services;


use Delight\Auth\Auth;

class Profile
{
    private $auth;
    private $database;
    private $notification;

    public function __construct(Auth $auth, Database $database, Notification $notification)
    {
        $this->auth = $auth;
        $this->database = $database;
        $this->notification = $notification;
    }

    public function changeInformation($newUsername = null, $newEmail){

        if ($this->auth->getEmail() != $newEmail) {

            $this->auth->changeEmail($newEmail, function ($selector, $token) use($newEmail) {
               $this->notification->changMail($newEmail, $selector, $token);
                flash()->success(['На вашу почту ' . $newEmail . ' был отправлен код с подтверждением.']);
            });
        }

        if(empty($newUsername)){
            $newUsername = $this->auth->getUsername();}

        $this->database->update('users', $this->auth->getUserId(), ['username' => $newUsername]);

    }

}