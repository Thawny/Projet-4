<?php

namespace CommandBundle\Controller;

use CommandBundle\Entity\visitor;
use CommandBundle\Form\visitorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function formAction()
    {
        $visitor = new visitor;
        $form = $this->get('form.factory')->create(visitorType::class, $visitor);

        return $this->render('CommandBundle:Default:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
