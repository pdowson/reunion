<?php

namespace App\Entity;

use App\Enum\ClassmateAttendanceStatusEnum;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassmateAttendanceRepository")
 */
class ClassmateAttendance extends BaseEntity
{
    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $num_attendees;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $response_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classmate", inversedBy="classmate_attendances")
     */
    private $classmate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassmateYear", inversedBy="classmate_attendance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classmate_year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attendees;

    public function __toString()
    {
        return
            $this->getClassmate()->__toString() . " - " .
            $this->getClassmateYear()->getReunionYear() . " - " .
            ($this->getStatus() ? ClassmateAttendanceStatusEnum::getDisplayName($this->getStatus()) : $this->getStatus()) .
            " - Attendance";
    }

    public function getNumAttendees(): ?int
    {
        return $this->num_attendees;
    }

    public function setNumAttendees(?int $num_attendees): self
    {
        $this->num_attendees = $num_attendees;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        if(!ClassmateAttendanceStatusEnum::isValidValue($status)){
            throw new \Exception("Invalid enumeration value for ClassmateAttendanceStatusEnum: ". $status);
        }

        $this->status = $status;

        return $this;
    }

    public function getResponseDate(): ?\DateTimeInterface
    {
        return $this->response_date;
    }

    public function setResponseDate(?\DateTimeInterface $response_date): self
    {
        $this->response_date = $response_date;

        return $this;
    }

    public function getClassmate(): ?Classmate
    {
        return $this->classmate;
    }

    public function setClassmate(?Classmate $classmate): self
    {
        $this->classmate = $classmate;

        return $this;
    }

    public function getClassmateYear(): ?ClassmateYear
    {
        return $this->classmate_year;
    }

    public function setClassmateYear(?ClassmateYear $classmate_year): self
    {
        $this->classmate_year = $classmate_year;

        return $this;
    }

    public function getAttendees(): ?string
    {
        return $this->attendees;
    }

    public function setAttendees(?string $attendees): self
    {
        $this->attendees = $attendees;

        return $this;
    }
}
