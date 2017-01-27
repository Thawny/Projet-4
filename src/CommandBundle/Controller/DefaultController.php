<?php

namespace CommandBundle\Controller;

use CommandBundle\Entity\command;
use CommandBundle\Entity\visitor;
use CommandBundle\Form\commandType;
use CommandBundle\Form\VisitorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function homeAction()
    {
        $command = new command();
        $visitor = new visitor();
        $form   = $this->get('form.factory')->create(VisitorType::class, $visitor);


        return $this->render('CommandBundle:Default:home.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function visitorsAction(Request $request)
    {
        /*$numberOfVisitors = $request->request->get('numberOfVisitors');
        $ieme = 0;
        $var1 = "visiteur";
        for ($x = 0; $x < $numberOfVisitors; $x++)
        {
            $ieme++;
            $var2 = $var1.$ieme;
            $$var2 = new visitor();
            $form = $this->get('form.factory')->create(visitorType::class, $$var2);

        }*/

        $visitor = new visitor();
        $form = $this->get('form.factory')->create(VisitorType::class, $visitor);

        return $this->render('CommandBundle:Default:visitorsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
