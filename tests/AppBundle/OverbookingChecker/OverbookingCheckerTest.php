<?php
/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 06/04/2017
 * Time: 19:48
 */

namespace AppBundle\OverbookingChecker;



use AppBundle\Entity\Command;
use AppBundle\Repository\InMemoryCommandGateway;
use PHPUnit\Framework\TestCase;


class OverbookingCheckerTest extends TestCase
{
    /**
     * @test
     * @expectedException \AppBundle\OverbookingChecker\Exception\TooManyReservationsException
     */
    public function alreadyMoreThanAThousand_ThrowsException(){
        $overBookingChecker = new OverbookingChecker();
        $overBookingChecker->setCommandGateway(new InMemoryCommandGateway());
        InMemoryCommandGateway::$countReservations = 1001;
        $overBookingChecker->checkReservationIsValid(new Command());
    }

    /**
     * @test
     * @expectedException \AppBundle\OverbookingChecker\Exception\TooManyReservationsException
     */
    public function addsUpToMoreThanAThousand_ThrowsException(){
        $overBookingChecker = new OverbookingChecker();
        $overBookingChecker->setCommandGateway(new InMemoryCommandGateway());
        InMemoryCommandGateway::$countReservations = 995;
        $command = new Command();
        $command->setNumberOfVisitors(7);
        $overBookingChecker->checkReservationIsValid($command);

    }

    /**
     * @test
     */
    public function lessThanAThousand_DoNothing(){

    }


}
