<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mail
{

    public function send($email, $body){

        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('adik13131331@gmail.com')
            ->setPassword('Ler@Ler@');

        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('Информация с сайта gallery@.loc'))
            ->setFrom(['info@mail.com' => 'Ali RU'])
            ->setTo($email)
            ->setBody($body);

// Send the message
        return $result = $mailer->send($message);

    }
}