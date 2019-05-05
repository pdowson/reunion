<?php

namespace App\Entity;

use App\Enum\ClassmateAttendanceStatusEnum;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;

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

    /**
     * @return string
     * @throws Exception
     */
    public function __toString()
    {
        return
            $this->getClassmate()->__toString() . " - " .
            $this->getClassmateYear()->getReunionYear() . " - " .
            ($this->getStatus() ? ClassmateAttendanceStatusEnum::getDisplayName($this->getStatus()) : $this->getStatus()) .
            " - Attendance";
    }

    /**
     * @return int|null
     */
    public function getNumAttendees(): ?int
    {
        return $this->num_attendees;
    }

    /**
     * @param int|null $num_attendees
     * @return ClassmateAttendance
     */
    public function setNumAttendees(?int $num_attendees): self
    {
        $this->num_attendees = $num_attendees;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return ClassmateAttendance
     * @throws Exception
     */
    public function setStatus(?string $status): self
    {
        if(!ClassmateAttendanceStatusEnum::isValidValue($status)){
            throw new Exception("Invalid enumeration value for ClassmateAttendanceStatusEnum: ". $status);
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getResponseDate(): ?DateTimeInterface
    {
        return $this->response_date;
    }

    /**
     * @param DateTimeInterface|null $response_date
     * @return ClassmateAttendance
     */
    public function setResponseDate(?DateTimeInterface $response_date): self
    {
        $this->response_date = $response_date;

        return $this;
    }

    /**
     * @return Classmate|null
     */
    public function getClassmate(): ?Classmate
    {
        return $this->classmate;
    }

    /**
     * @param Classmate|null $classmate
     * @return ClassmateAttendance
     */
    public function setClassmate(?Classmate $classmate): self
    {
        $this->classmate = $classmate;

        return $this;
    }

    /**
     * @return ClassmateYear|null
     */
    public function getClassmateYear(): ?ClassmateYear
    {
        return $this->classmate_year;
    }

    /**
     * @param ClassmateYear|null $classmate_year
     * @return ClassmateAttendance
     */
    public function setClassmateYear(?ClassmateYear $classmate_year): self
    {
        $this->classmate_year = $classmate_year;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAttendees(): ?string
    {
        return $this->attendees;
    }

    /**
     * @param string|null $attendees
     * @return ClassmateAttendance
     */
    public function setAttendees(?string $attendees): self
    {
        $this->attendees = $attendees;

        return $this;
    }
}
