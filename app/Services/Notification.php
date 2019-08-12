<?php


namespace App\Services;

class Notification
{
    public $mail;

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    public function changMail($email, $username, $selector, $token){
        $massage = 'http://gallery.loc/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mail->send('adik13131331@gmail.com', $username, $massage);
    }
}