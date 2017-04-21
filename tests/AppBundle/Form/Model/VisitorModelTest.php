<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 19/04/2017
 * Time: 12:53
 */

namespace AppBundle\Form\Model;

use PHPUnit\Framework\TestCase;
use AppBundle\Form\Model\VisitorModel;

class VisitorModelTest extends TestCase
{

    public function testTicketPriceCalculator_twoYearsOldReturnsZero() {
        $visitorModel = new VisitorModel();
        $now = $visitorModel->birthday = new \DateTime();
        $now->format('d-m-Y');
        $now->modify('-2 years');

        $ticketPrice = $visitorModel->ticketPriceCalculator();
        $this->assertEquals(0, $ticketPrice);
    }

    public function testTicketPriceCalculator_sixYearsOldReturnsEight() {
        $visitorModel = new VisitorModel();
        $now = $visitorModel->birthday = new \DateTime();
        $now->format('d-m-Y');
        $now->modify('-6 years');

        $ticketPrice = $visitorModel->ticketPriceCalculator();
        $this->assertEquals(8, $ticketPrice);
    }
}