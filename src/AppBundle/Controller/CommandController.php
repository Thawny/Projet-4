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


        $commandModel = new CommandModel();

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


//            $this->get('custom.mailer')->sendConfirmationMail();
            return $this->render('AppBundle:Default:visitorsForm.html.twig', array('model' => $command));
        }

        return $this->render('AppBundle:Default:home.html.twig', array(
            'form' => $commandForm->createView()
        ));

    }



    public function processPaymentAction(Request $request)
    {
        $command = $request->getSession()->get('command');
        $commandFactory = $this->get('command.factory');
        $commandEntity = $commandFactory->create($command);


        $token = $request->get('stripeToken');
        \Stripe\Stripe::setApiKey("");

        $overbookingChecker = $this->get('overbooking.checker');
        if ($overbookingChecker->isValidReservation($commandEntity) === true)
        {
            $commandRepository = $this->get('command.repository');
            $commandRepository->insert($commandEntity);
//            \Stripe\Charge::retrieve(
//                $token,
//                array('api_key' => "sk_test_O321nE3YtINTDtnR9t66uFGN")
//            );
            \Stripe\Stripe::setApiKey("");
            $this->chargeUserCreditCart($token);

            $this->get('custom.mailer')->sendConfirmationMail($command);

            return $this->render('AppBundle:Default:paymentSuccess.html.twig');
        } else {
            $numberOfTicketsLeft = $overbookingChecker->isValidReservation($commandEntity);
            $flashMessage = "Nombre de tickets insuffisant, il ne reste que ".$numberOfTicketsLeft;
            $this->get('session')->getFlashBag()->add('insuffisant', $flashMessage);
            return $this->redirectToRoute('show_command_form');
        }
//        try{
//            $this->chargeUserCreditCart($token);
//        } catch (Exception $e) {
//            return $this->redirect();
//        }
//        vérifier les place disponibles
//        if(true){
//        }




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
    protected function chargeUserCreditCart($token, $amount)
    {
        return $charge = \Stripe\Charge::create(array(
            "amount" => $amount,
            "currency" => "eur",
            "description" => "Example charge",
            "source" => $token
        ));
    }
}

