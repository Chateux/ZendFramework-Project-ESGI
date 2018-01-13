<?php
declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @package Meetup\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetup")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Meetup\Entity\Organisator")
     * @ORM\JoinColumn(name="idMeetup", referencedColumnName="id")
     */
    private $idMeetup;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startdate;
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $enddate;

    public function __construct(string $title, string $description = '', \DateTime $startdate, \DateTime $enddate)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->idMeetup = new ArrayCollection();
        $this->title = $title;
        $this->description = $description;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return Meetup
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getIdMeetup()
    {
        return $this->idMeetup;
    }

    /**
     * @param mixed $idMeetup
     */
    public function setIdMeetup($idMeetup): void
    {
        $this->idMeetup = $idMeetup;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Meetup
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Meetup
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set start date.
     *
     * @param \DateTime $startdate
     *
     * @return Meetup
     */
    public function setStartDate($startdate)
    {
        $this->startdate = $startdate;
        return $this;
    }

    /**
     * Get start date.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startdate;
    }

    /**
     * Set end date.
     *
     * @param \DateTime $enddate
     *
     * @return Meetup
     */
    public function setEndDate($enddate)
    {
        $this->enddate = $enddate;
        return $this;
    }

    /**
     * Get end date.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->enddate;
    }
}