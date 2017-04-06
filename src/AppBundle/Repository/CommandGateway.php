<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 06/04/2017
 * Time: 20:02
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Command;

interface CommandGateway
{
    public function insert(Command $command);

    public function countReservationAt($dateVisit);
}