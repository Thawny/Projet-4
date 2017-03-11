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
     * @Assert\NotBlank(message="Veuillez saisir votre email")
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
     * @return ArrayCollection|VisitorModel[]
     *
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
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }

    public function removeVisitor(VisitorModel $visitor)
    {
        $this->visitors->removeElement($visitor);
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

    /**
     * @Assert\Callback()
     * @param OptionsResolverInterface $context
     */
    public function isEmailValid(ExecutionContextInterface $context)
    {
        $email = $this->getEmail();

        if (strlen($email) > 50 || strlen($email) < 3 || !preg_match('#@#', $email) || !preg_match('#.#', $email))
        {
            $context->buildViolation('Ceci n\'est pas un email valide')
                ->atPath('email')
                ->addViolation();
        }
    }

    /**
     * @Assert\Callback()
     * @param OptionsResolverInterface $context
     */
    public function isDateVisitPast(ExecutionContextInterface $context)
    {
        $dateVisit = $this->getDateVisit();
        $today = new \DateTime();

        if ($dateVisit < $today)
        {
            $context->buildViolation('Vous ne pouvez pas réserver pour une date passée')
                ->atPath('dateVisit')
                ->addViolation();
        }
    }



}