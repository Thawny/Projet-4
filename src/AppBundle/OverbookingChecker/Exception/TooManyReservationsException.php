<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 14/04/2017
 * Time: 19:24
 */

namespace AppBundle\OverbookingChecker\Exception;



class TooManyReservationsException extends \Exception
{
    function __construct(int $leftTickets = null)
    {
        $this->leftTickets = $leftTickets;
        parent::__construct();
    }

    private $leftTickets;

    /**
     * @return int
     */
    public function getLeftTickets()
    {
        return $this->leftTickets;
    }


}