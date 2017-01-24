<?php

namespace CommandBundle\Controller;

use CommandBundle\Entity\command;
use CommandBundle\Entity\visitor;
use CommandBundle\Form\commandType;
use CommandBundle\Form\visitorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function formAction()
    {
        $visitor = new visitor;
        $form = $this->get('form.factory')->create(visitorType::class, $visitor);

        $command = new command;
        $commandForm = $this->get('form.factory')->create(commandType::class, $command);

        return $this->render('CommandBundle:Default:form.html.twig', array(
            'form' => $form->createView(), 'commandForm' => $commandForm->createView()
        ));
    }
}
