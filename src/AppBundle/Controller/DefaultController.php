<?php

namespace AppBundle\Controller;

use AppBundle\Form\Model\CommandModel;
use AppBundle\Form\Type\CommandType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\VisitorModel;


class DefaultController extends Controller
{
    public function homeAction(Request $request)
    {
//        if($this->get('session')->isStarted()){
//            $this->get('session')->getBag('commande');
//        }

        if ($request->isMethod('POST'))
        {
            return $this->redirectToRoute('command_visitorform');
        }

        $this->get('session');
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

    public function postCommandAction(Request $request)
    {

        // Récupère le form
        if ($request->isMethod('POST')) {
            $form = $this->get('form.factory')->create(CommandType::class, $request);

            if ($form->handleRequest($request)->isValid()) {

            }
            else {

            }

        }
        else {
            return $this->redirectToRoute('command_homepage');
        }



        // tu le valides
        // si valide
        // tu sauvegardes la commande
        // sinon tu affiches les erreurs
    }
}
