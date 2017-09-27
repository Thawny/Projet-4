<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Command;
use AppBundle\Entity\CommandFactory;
use AppBundle\Entity\VisitorFactory;
use AppBundle\Form\Model\CommandModel;
use AppBundle\Form\Model\ConfirmationPaymentModel;
use AppBundle\Form\Type\CommandType;
use AppBundle\Form\Type\ConfirmationPaymentType;
use AppBundle\OverbookingChecker\Exception\TooManyReservationsException;
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
            $command->setCodeResa($command->makeCodeResa());
            $command->bindTotalAmount();
            $session->set('command', $command);


            return $this->render('AppBundle:Default:visitorsForm.html.twig', array('model' => $command));
        }

        return $this->render('AppBundle:Default:home.html.twig', array(
            'form' => $commandForm->createView()
        ));

    }



    public function processPaymentAction(Request $request)
    {
        try {
            $command = $request->getSession()->get('command');
            $commandFactory = $this->get('command.factory');
            $commandEntity = $commandFactory->create($command);

            $amount = $command->getTotalAmount();


            $token = $request->get('stripeToken');

            $overbookingChecker = $this->get('overbooking.checker');

            $overbookingChecker->checkReservationIsValid($commandEntity);
            $commandRepository = $this->get('command.repository');
            $commandRepository->insert($commandEntity);

            \Stripe\Stripe::setApiKey($this->getParameter('stripe_api_key'));
            $this->chargeUserCreditCart($token, $amount);

            $this->get('custom.mailer')->sendConfirmationMail($command);

            return $this->render('AppBundle:Default:paymentSuccess.html.twig');

        } catch (TooManyReservationsException $e) {
            $flashMessage = "Nombre de tickets insuffisant, il ne reste que ". $e->getLeftTickets();
            $this->get('session')->getFlashBag()->add('insuffisant', $flashMessage);
            return $this->redirectToRoute('show_command_form');
        }


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
        $stripeFormatAmount = (string) $amount;
        $stripeFormatAmount = $stripeFormatAmount . "00";
        $stripeFormatAmount = (int) $stripeFormatAmount;

        return $charge = \Stripe\Charge::create(array(
            "amount" => $stripeFormatAmount,
            "currency" => "eur",
            "description" => "Example charge",
            "source" => $token
        ));
    }





}





