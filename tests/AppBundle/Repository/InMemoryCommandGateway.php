<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 06/04/2017
 * Time: 20:15
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Command;

class InMemoryCommandGateway implements CommandGateway
{
    public static $countReservations;

    public function insert(Command $command)
    {
        // TODO: Implement insert() method.
    }

    public function countReservationAt($dateVisit)
    {
        return self::$countReservations;
    }

}
