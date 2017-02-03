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
     * @Assert\Length(min=2,
     *     max=50,
     *     minMessage="Votre email doit comprendre au moins deux charactères",
     *      maxMessage="Votre email ne peut pas comprendre plus cinquante charactères "
     *   )
     */
    public $email;

    public $fullDayTickets;

    /**
     * @var ArrayCollection
     * @Assert\Valid()
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