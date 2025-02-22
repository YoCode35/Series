<?php

namespace App\Notification;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Sender
{
    //protected $mailer;
    public function __construct(protected MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function sendNewUserNotificationToAdmin(UserInterface $user): void
    {
        //Pour tester
        //file_put_contents('debug.txt', $user->getEmail());

        $message = new Email();
        $message->from('accounts@series.com')
            ->to('admin@series.com')
            ->subject('new account created in series.com !')
            ->html('<h1>New account</h1>email:' . $user->getEmail());


        $this->mailer->send($message);
    }
}