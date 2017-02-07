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




}