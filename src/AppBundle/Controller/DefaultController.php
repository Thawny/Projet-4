<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Visitor;
use AppBundle\Form\Model\CommandModel;
use AppBundle\Form\Type\CommandType;
use AppBundle\Form\Type\VisitorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\VisitorModel;


class DefaultController extends Controller
{
    public function homeAction()
    {
        $tony = new VisitorModel();
        $tony->birthday = new \DateTime();
        $tony->country = "France";
        $tony->discount = true;
        $tony->firstName = "Tony";
        $tony->lastName = "Malto";

        $paul = new VisitorModel();
        $paul->birthday = new \DateTime();
        $paul->country = "Iran";
        $paul->discount = true;
        $paul->firstName = "Paul";
        $paul->lastName = "Machin";


        $commandModel = new CommandModel();
        $commandModel->visitors->add($tony);
        $commandModel->visitors->add($paul);
        $form = $this->get('form.factory')->create(CommandType::class, $commandModel);


        return $this->render('AppBundle:Default:home.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function visitorsAction()
    {
        /*$numberOfVisitors = $request->request->get('numberOfVisitors');
        $ieme = 0;
        $var1 = "visiteur";
        for ($x = 0; $x < $numberOfVisitors; $x++)
        {
            $ieme++;
            $var2 = $var1.$ieme;
            $$var2 = new Visitor();
            $form = $this->get('form.factory')->create(visitorType::class, $$var2);

        }*/

        $visitor = new Visitor();
        $form = $this->get('form.factory')->create(VisitorType::class, $visitor);

        return $this->render('AppBundle:Default:visitorsForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
