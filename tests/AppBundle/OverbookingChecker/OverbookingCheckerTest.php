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
     */
    public function addsUpToMoreThanAThousand_ReturnsUnvalidReservation(){
        $overBookingChecker = new OverbookingChecker();
        $overBookingChecker->setCommandGateway(new InMemoryCommandGateway());
        InMemoryCommandGateway::$countReservations = 1001;
        $actual = $overBookingChecker->isValidReservation(new Command());
        $this->assertFalse($actual);
    }

//    public function TotalReservationIncludingThisCommandOverAThousand_ReturnsRefusedCommand(){
//
//    }


}
