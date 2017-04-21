<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 09/03/2017
 * Time: 15:33
 */

namespace AppBundle\OverbookingChecker;

use AppBundle\Entity\Command;
use AppBundle\OverbookingChecker\Exception\TooManyReservationsException;
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


    public function setCommandGateway(CommandGateway $commandGateway)
    {
        $this->commandGateway = $commandGateway;
    }

    /**
     * @param Command $command
     * @throws TooManyReservationsException
     */
    public function checkReservationIsValid(Command $command)
    {
        $dateVisit = $command->getDateVisit();
        $totalReservations = $this->commandGateway->countReservationAt($dateVisit);

        if ($command->getNumberOfVisitors() + $totalReservations > 1000) {
            throw new TooManyReservationsException(1000 - $totalReservations);
        }
    }
}