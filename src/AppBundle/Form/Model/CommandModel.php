<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 28/01/2017
 * Time: 16:08
 */

namespace AppBundle\Form\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class CommandModel
{
    public $dateVisit;

    /**
     * @Assert\NotBlank(message="Vous devez saisir votre email")
     */
    public $email;

    public $fullDayTickets;

    /**
     * @var ArrayCollection
     * @Assert\Valid()
     * @Assert\IsNull(
     *     message="La commande doit comporter au moins un visiteur"
     * )
     */
    public $visitors;

    /**
     * CommandModel constructor.
     */
    public function __construct()
    {
        $this->visitors = new ArrayCollection();
    }


}