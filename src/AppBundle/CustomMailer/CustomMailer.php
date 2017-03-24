<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/03/2017
 * Time: 10:10
 */

namespace AppBundle\CustomMailer;

class CustomMailer
{
    private $mailer;
    private $twig_Environment;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig_Environment)
    {
        $this->mailer = $mailer;
        $this->twig_Environment = $twig_Environment;
    }

    public function sendConfirmationMail()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Musée du Louvre - Confirmation')
            ->setFrom('tony.louvre.projet3@gmail.com')
            ->setTo('tony.malto.simon@gmail.com')
            ->setContentType('text/html')
            ->setBody(
                $this->twig_Environment->render('@App/Default/email.html.twig')
            );
        $this->mailer->send($message);
    }

}