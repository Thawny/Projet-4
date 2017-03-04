<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Command;
use AppBundle\Entity\CommandFactory;
use AppBundle\Entity\VisitorFactory;
use AppBundle\Form\Model\CommandModel;
use AppBundle\Form\Model\ConfirmationPaymentModel;
use AppBundle\Form\Type\CommandType;
use AppBundle\Form\Type\ConfirmationPaymentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Tests\Compiler\C;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\VisitorModel;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;


class CommandController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
//        if($this->get('session')->isStarted()){
//            $this->get('session')->getBag('commande');

//        $session = new Session();


//        $this->get('session');
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
//        $commandModel->visitors->add($tony);
//        $commandModel->visitors->add($paul);

        if ($this->get('session')->has('command'))
        {
            $commandModel = $this->get("session")->get('command');
        }

        $form = $this->get('form.factory')->create(CommandType::class, $commandModel);
        return $this->render('AppBundle:Default:home.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function postCommandAction(Request $request)
    {

        // Récupère le form
        $commandModel = new CommandModel();
        $commandForm = $this->get('form.factory')->create(CommandType::class, $commandModel);



        if ($commandForm->handleRequest($request)->isValid())
        {
            $session = $this->get('session');
            $command = $commandForm->getData();
            $session->set('command', $command);

            return $this->render('AppBundle:Default:visitorsForm.html.twig', array('model' => $command));
        }

        return $this->render('AppBundle:Default:home.html.twig', array(
            'form' => $commandForm->createView()
        ));

    }



    public function processPaymentAction(Request $request)
    {
        $command = $request->getSession()->get('command');
        \Stripe\Stripe::setApiKey("");
//        $token = $request->get('stripeToken');
//        try{
//            $this->chargeUserCreditCart($token);
//        } catch (Exception $e) {
//            return $this->redirect();
//        }
        // vérifier les place disponibles
//        if(true){
//            $this
//                ->get('command.repository')
//                ->insert($command);
//        }

        $commandFactory = new CommandFactory();
        $visitorFactory = new VisitorFactory();
        $commandFactory->setVisitorFactory($visitorFactory);
        $commandEntity = $commandFactory->create($command);
        $em  = $this->getDoctrine()->getManager();
        $em->persist($commandEntity);
        $em->flush();

        return $this->render('AppBundle:Default:paymentSuccess.html.twig');
    }
    /**
     * @param $form
     * @return CommandModel
     */
    private function getCommandModel(\Symfony\Component\Form\Form $form)
    {
        return $form->getData();
    }
    /**
     * @param $token
     * @return \Stripe\Charge
     */
    protected function chargeUserCreditCart($token)
    {
        return $charge = \Stripe\Charge::create(array(
            "amount" => 10,
            "currency" => "eur",
            "description" => "Example charge",
            "source" => $token
        ));
    }
}

