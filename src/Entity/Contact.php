<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classmate", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $classmate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $current_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $significant_other;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info_string;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassmateYear", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classmate_year;


    public function getClassmate(): ?Classmate
    {
        return $this->classmate;
    }

    public function setClassmate(?Classmate $classmate): self
    {
        $this->classmate = $classmate;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCurrentName(): ?string
    {
        return $this->current_name;
    }

    /**
     * @param string $current_name
     * @return Contact
     */
    public function setCurrentName(?string $current_name): self
    {
        $this->current_name = $current_name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSignificantOther(): ?string
    {
        return $this->significant_other;
    }

    /**
     * @param null|string $significant_other
     * @return Contact
     */
    public function setSignificantOther(?string $significant_other): self
    {
        $this->significant_other = $significant_other;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress1(): ?string
    {
        return $this->address_1;
    }

    /**
     * @param string $address_1
     * @return Contact
     */
    public function setAddress1(?string $address_1): self
    {
        $this->address_1 = $address_1;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress2(): ?string
    {
        return $this->address_2;
    }

    /**
     * @param null|string $address_2
     * @return Contact
     */
    public function setAddress2(?string $address_2): self
    {
        $this->address_2 = $address_2;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Contact
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Contact
     */
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return Contact
     */
    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Contact
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getInfoString(): ?string
    {
        return $this->info_string;
    }

    public function setInfoString(?string $info_string): self
    {
        $this->info_string = $info_string;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
}
