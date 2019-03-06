<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassmateAddressRepository")
 */
class ClassmateAddress extends BaseEntity
{
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Classmate", inversedBy="classmate_addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classmate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassmateYear", inversedBy="classmate_address")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classmate_year;

    public function __toString()
    {
        return
            $this->getClassmate()->__toString() . " - " .
            $this->getClassmateYear()->getReunionYear() . "" .
            ($this->getAddress1() ? " - " . $this->getAddress1() : "") .
            ($this->getAddress2() ? ", " . $this->getAddress2() : "") .
            ($this->getCity() ? ", " . $this->getCity() : "") .
            ($this->getState() ? ", " . $this->getState() : "") .
            ($this->getZip() ? ", " . $this->getZip() : "");
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
     * @return ClassmateAddress
     */
    public function setAddress1(string $address_1): self
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
     * @return ClassmateAddress
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
     * @return ClassmateAddress
     */
    public function setCity(string $city): self
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
     * @return ClassmateAddress
     */
    public function setState(string $state): self
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
     * @return ClassmateAddress
     */
    public function setZip(string $zip): self
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
     * @return ClassmateAddress
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
     * @return ClassmateAddress
     */
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

}
