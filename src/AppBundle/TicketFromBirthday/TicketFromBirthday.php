<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 16/02/2017
 * Time: 16:00
 */
namespace AppBundle\TicketFromBirthday;

class TicketFromBirthday
{
    public function ticketPrice($birthday, $discount)
    {
        $today = new \DateTime();
        $today->format('d-m-Y');

        if ($today->modify('-4 years') < $birthday)
        {
            return 0;
        }
        elseif ($today->modify('-4 years') > $birthday && $today->modify('-12 years') > $birthday)
        {
            return 8;
        }
        elseif ($today->modify('-12 years') > $birthday && $today->modify('-60 years') > $birthday)
        {
            if ($discount)
            {
                return 10;
            }
            else
            {
                return 16;
            }
        }
        else
        {
            return 12;
        }
    }
}