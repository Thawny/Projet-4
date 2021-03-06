<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * visitor
 *
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VisitorRepository")
 */
class Visitor
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var bool
     *
     * @ORM\Column(name="discount", type="boolean")
     */
    private $discount;

    /**
     * @var float
     *
     * @ORM\Column(name="ticket_fee", type="float", nullable=true)
     */
    private $ticketFee;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Command",inversedBy="visitors", cascade={"persist"})
     * @ORM\JoinColumn(name="command", referencedColumnName="id")
     */
    private $command;

    /**
     * @var string
     * @ORM\Column(name="country", type="string")
     */
    private $country;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Visitor
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Visitor
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Visitor
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set discount
     *
     * @param boolean $discount
     *
     * @return Visitor
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return bool
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set ticketFee
     *
     * @param float $ticketFee
     *
     * @return Visitor
     */
    public function setTicketFee($ticketFee)
    {
        $this->ticketFee = $ticketFee;

        return $this;
    }

    /**
     * Get ticketFee
     *
     * @return float
     */
    public function getTicketFee()
    {
        return $this->ticketFee;
    }

    /**
     * Set Command
     *
     * @param \stdClass $command
     *
     * @return Visitor
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return \stdClass
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Visitor
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function getPrice(){
        // copier le code de ton service TixketFromBirthday
        return 0;
    }
}
