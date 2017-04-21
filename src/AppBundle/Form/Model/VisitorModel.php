<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 28/01/2017
 * Time: 16:08
 */

namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class VisitorModel
{
    /**
     * @Assert\Length(min=2,
     *     max=50,
     *     minMessage="Votre prénom doit comprendre au moins deux charactères",
     *      maxMessage="Votre prénom ne peut pas comprendre plus cinquante charactères "
     *   )
     */
    public $firstName;

    /**
     * @Assert\Length(min=1,
     *     max=50,
     *     minMessage="Votre nom doit comprendre au moins deux charactères",
     *      maxMessage="Votre nom ne peut pas comprendre plus cinquante charactères "
     *   )
     */
    public $lastName;

    public $birthday;

    public $country;

    public $discount;

    public $ticket_price = 0;

    /**
     * @return mixed
     */
    public function getTicketPrice()
    {
        if ($this->ticket_price == 0)
        {
            $this->setTicketPrice($this->ticketPriceCalculator());
        }
        return $this->ticket_price;
    }

    /**
     * @param $ticket_price
     */
    public function setTicketPrice($ticket_price)
    {
        $this->ticket_price = $ticket_price;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param ExecutionContextInterface $
     * @Assert\Callback()
     */
    public function isBirthday(ExecutionContextInterface $context)
    {
        $dateVisit = $this->getBirthday();
        $today = new \DateTime();

        if ($dateVisit > $today)
        {
            $context->buildViolation('Le champ anniversaire ne peut pas désigner une date future')
                ->atPath('birthday')
                ->addViolation();
        }
    }

    // de 0 à 4   => gratuit
    // de 4 à 12  => 8 euros
    // de 12 à 60 => tarif réduit   => 10 euros
    //            sans tarif réduit => 16 euros
    // à partir de 60 => 12 euros

    public function ticketPriceCalculator()
    {
        $birthday = $this->getBirthday();
        $birthday->format('d-m-Y');
        $discount = $this->discount;

        $today = new \DateTime();
        $today->format('d-m-Y');

        if ($today->modify('-4 years') < $birthday)
        {
            return 0;
        }
        elseif (($today > $birthday) && ($today->modify('-8 years') < $birthday))
        {
            return 8;
        }
        elseif ($today > $birthday && $today->modify('-48 years') < $birthday)
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