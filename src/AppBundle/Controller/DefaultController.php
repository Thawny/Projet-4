<?php

namespace AppBundle\Controller;

use AppBundle\Entity\command;
use AppBundle\Entity\visitor;
use AppBundle\Form\commandType;
use AppBundle\Form\VisitorType;
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


        return $this->render('AppBundle:Default:home.html.twig', array(
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

        return $this->render('AppBundle:Default:visitorsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
