<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 09/03/2017
 * Time: 15:33
 */

namespace AppBundle\OverbookingChecker;

use AppBundle\Entity\Command;

/**
 * Class OverbookingChecker
 */
class OverbookingChecker
{
    private $commandRepository;

//    public function __construct(\AppBundle\Repository\CommandRepository $commandRepository)
//    {
//        $this->commandRepository = $commandRepository;
//    }

    public function setCommandRepository($commandRepository)
    {
        $this->commandRepository = $commandRepository;
    }

    public function isValidReservation(Command $command)
    {
        $dateVisit = $command->getDateVisit();
        $totalReservations = $this->commandRepository->countReservationAt($dateVisit);

        if ($command->getNumberOfVisitors()+ $totalReservations <= 1000)
            return true;
        else {
            $leftTickets = 1000 - $totalReservations;
            return $leftTickets;
        }
    }
}