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

    public function setCommandRepository(\AppBundle\Repository\CommandRepository $commandRepository)
    {
        $this->commandRepository = $commandRepository;
    }

    public function isValidReservation(Command $command)
    {
        $dateVisit = $command->getDateVisit();
        $totalReservetions = $this->commandRepository->countReservationAt($dateVisit);

        if ($command->getNumberOfVisitors()+ $totalReservetions <= 1000)
            return true;
        else {
            $leftTickets = 1000 - $totalReservetions;
            return $leftTickets;
        }
    }
}