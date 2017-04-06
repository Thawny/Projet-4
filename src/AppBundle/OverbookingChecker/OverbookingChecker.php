<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 09/03/2017
 * Time: 15:33
 */

namespace AppBundle\OverbookingChecker;

use AppBundle\Entity\Command;
use AppBundle\Repository\CommandGateway;

/**
 * Class OverbookingChecker
 */
class OverbookingChecker
{
    /**
     * @var CommandGateway
     */
    private $commandGateway;

//    public function __construct(\AppBundle\Repository\CommandRepository $commandRepository)
//    {
//        $this->commandRepository = $commandRepository;
//    }


    public function setCommandGateway(CommandGateway $commandGateway)
    {
        $this->commandGateway = $commandGateway;
    }

    public function isValidReservation(Command $command)
    {
        $dateVisit = $command->getDateVisit();
        $totalReservations = $this->commandGateway->countReservationAt($dateVisit);

        if ($command->getNumberOfVisitors()+ $totalReservations <= 1000)
            return true;
        else {
            $leftTickets = 1000 - $totalReservations;
            return $leftTickets;
        }
    }
}