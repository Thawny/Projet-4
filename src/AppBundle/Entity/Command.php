<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandRepository")
 */
class Command
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="code_resa", type="string", length=255, nullable=true)
     */
    private $codeResa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_resa", type="datetime", nullable=true)
     */
    private $dateResa;

    /**
     * @var date
     * @ORM\Column(name="date_visit", type="date", nullable=false)
     */
    private $dateVisit;

    /**
     * @var boolean
     * @ORM\Column(name="full_day_tickets", type="boolean", nullable=false)
     */
    private $fullDayTickets;


    /**
     * @var Visitor[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Visitor",mappedBy="command", cascade={"persist"})
     */
    private $visitors;

    /**
     * @param Visitor[] $visitors
     */
    public function setVisitors($visitors)
    {
        $this->visitors = $visitors;
    }

    /**
     * Command constructor.
     * @param Visitor[] $visitors
     */
    public function __construct()
    {
        $this->visitors = new ArrayCollection();
//        $this->setDateResa(new \DateTime());
    }

    /**
     * @param Visitor $visitor
     */
    public function addVisitor(Visitor $visitor){
        $this->visitors->add($visitor);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Command
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set codeResa
     *
     * @param string $codeResa
     *
     * @return Command
     */
    public function setCodeResa($codeResa)
    {
        $this->codeResa = $codeResa;

        return $this;
    }

    /**
     * Get codeResa
     *
     * @return string
     */
    public function getCodeResa()
    {
        return $this->codeResa;
    }

    /**
     * Set dateResa
     *
     * @param \DateTime $dateResa
     *
     * @return Command
     */
    public function setDateResa($dateResa)
    {
        $this->dateResa = $dateResa;

        return $this;
    }

    /**
     * Get dateResa
     *
     * @return \DateTime
     */
    public function getDateResa()
    {
        return $this->dateResa;
    }

    /**
     * Set dateVisit
     *
     * @param \DateTime $dateVisit
     *
     * @return Command
     */
    public function setDateVisit($dateVisit)
    {
        $this->dateVisit = $dateVisit;

        return $this;
    }

    /**
     * Get dateVisit
     *
     * @return \DateTime
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }

    /**
     * Set fullDayTickets
     *
     * @param boolean $fullDayTickets
     *
     * @return Command
     */
    public function setFullDayTickets($fullDayTickets)
    {
        $this->fullDayTickets = $fullDayTickets;

        return $this;
    }

    /**
     * Get fullDayTickets
     *
     * @return boolean
     */
    public function getFullDayTickets()
    {
        return $this->fullDayTickets;
    }

    /**
     * Set numberOfVisitors
     *
     * @param integer $numberOfVisitors
     *
     * @return Command
     */


    /**
     * Get numberOfVisitors
     *
     * @return integer
     */
    public function getNumberOfVisitors()
    {
        return $this->visitors->count();
    }

    public function getTotalAmount(){
        $totalAmount = 0;
        foreach($this->visitors as $visitor){
            $totalAmount+=$visitor->getPrice();
        }

        return $totalAmount;
    }
}
