<?php
declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @package Meetup\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\Atendees")
 * @ORM\Table(name="atendees")
 */
class Atendees
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="\Meetup\Entity\Meetup")
     * @ORM\JoinColumn(name="idMeet", referencedColumnName="id")
     */
    private $idMeet;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastname;
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstname;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;


    public function __construct(string $lastname, string $firstname, \DateTime $date)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->idMeet = new ArrayCollection();
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->date = $date;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdMeet()
    {
        return $this->idMeet;
    }

    /**
     * @param mixed $idMeet
     */
    public function setIdMeet($idMeet): void
    {
        $this->idMeet = $idMeet;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }


}