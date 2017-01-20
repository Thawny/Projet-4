<?php

namespace CommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CommandBundle:Default:index.html.twig');
    }
}
