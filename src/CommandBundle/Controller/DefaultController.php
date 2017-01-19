<?php

namespace CommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultControllerController extends Controller
{
    public function formAction()
    {
        return $this->render('CommandBundle:Home:form.html.twig');
    }
}
