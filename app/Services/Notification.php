<?php

namespace App\Services;

class Notification
{
    public $mail;

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    public function changMail($email, $selector, $token){
        $message = 'http://gallery.loc/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mail->send('adik13131331@gmail.com', $message);
//        $this->mail->send($email, $message);
    }

    public function resetPassword($email, $selector, $token){
        $message = 'http://gallery.loc/reset_password/form?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mail->send('adik13131331@gmail.com', $message);
//        $this->mail->send($email, $message);
    }
}