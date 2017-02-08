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
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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
     *
     */
    public $visitors;

    /**
     * CommandModel constructor.
     */
    public function __construct()
    {
        $this->visitors = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getVisitors()
    {
        return $this->visitors;
    }

    /**
     * @param ArrayCollection $visitors
     */
    public function setVisitors($visitors)
    {
        $this->visitors = $visitors;
    }

    /**
     * @Assert\Callback()
     * @param OptionsResolverInterface $context
     */
    public function isVisitorsEmpty(ExecutionContextInterface $context)
    {
        if ($this->visitors->isEmpty())
        {
            $context->buildViolation('Votre commande doit comporter au moins un vsiteur')
                ->atPath('visitors')
                ->addViolation();
        }
    }


}