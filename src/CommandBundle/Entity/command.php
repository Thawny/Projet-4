<?php

namespace CommandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="CommandBundle\Repository\commandRepository")
 */
class command
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
     * @ORM\Column(name="date_resa", type="datetime")
     */
    private $dateResa;


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
     * @return command
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
     * @return command
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
     * @return command
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
}

