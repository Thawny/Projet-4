<?php

namespace CommandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * visitor
 *
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="CommandBundle\Repository\visitorRepository")
 */
class visitor
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
     * @ORM\Column(name="ticket_fee", type="float")
     */
    private $ticketFee;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="command", type="object")
     * @ORM\ManyToOne(targetEntity="CommandBundle\Entity\command")
     * @ORM\JoinColumn(nullable=false)
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
     * @return visitor
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
     * @return visitor
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
     * @return visitor
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
     * @return visitor
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
     * @return visitor
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
     * Set command
     *
     * @param \stdClass $command
     *
     * @return visitor
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
     * @return visitor
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
}
