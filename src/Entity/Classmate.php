<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassmateRepository")
 */
class Classmate extends BaseEntity
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $current_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $significant_other;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassmateAddress", mappedBy="classmate", orphanRemoval=true)
     */
    private $classmate_addresses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassmateInfo", mappedBy="classmate", orphanRemoval=true)
     */
    private $classmate_infos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassmateAttendance", mappedBy="classmate", orphanRemoval=true)
     */
    private $classmate_attendances;

    /**
     * @ORM\Column(type="string", options={"default" : "not_missing"})
     */
    private $is_missing;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="classmate", orphanRemoval=true)
     */
    private $contacts;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $is_deceased;

    public function __construct()
    {
        $this->classmate_addresses = new ArrayCollection();
        $this->classmate_infos = new ArrayCollection();
        $this->classmate_attendances = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function __toString()
    {
        return ($this->getCurrentName() !== "" && !is_null($this->getCurrentName()) ? $this->getCurrentName() : $this->getFirstName() . " " . $this->getLastName());
    }

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @return Classmate
     */
    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     * @return Classmate
     */
    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

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
     * @return Classmate
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
     * @return Classmate
     */
    public function setSignificantOther(?string $significant_other): self
    {
        $this->significant_other = $significant_other;

        return $this;
    }

    /**
     * @return Collection|ClassmateAddress[]
     */
    public function getClassmateAddresses(): Collection
    {
        return $this->classmate_addresses;
    }

    /**
     * @param ClassmateAddress $classmateAddress
     * @return Classmate
     */
    public function addClassmateAddress(ClassmateAddress $classmateAddress): self
    {
        if (!$this->classmate_addresses->contains($classmateAddress)) {
            $this->classmate_addresses[] = $classmateAddress;
            $classmateAddress->setClassmate($this);
        }

        return $this;
    }

    /**
     * @param ClassmateAddress $classmateAddress
     * @return Classmate
     */
    public function removeClassmateAddress(ClassmateAddress $classmateAddress): self
    {
        if ($this->classmate_addresses->contains($classmateAddress)) {
            $this->classmate_addresses->removeElement($classmateAddress);
            // set the owning side to null (unless already changed)
            if ($classmateAddress->getClassmate() === $this) {
                $classmateAddress->setClassmate(null);
            }
        }

        return $this;
    }

    /**
     * This function needs to return classmate info's sorted by year, since the year can be entered at any order
     * @return Collection|ClassmateInfo[]
     */
    public function getClassmateInfos(): Collection
    {
        /** @var \ArrayIterator $iterator */
        $iterator = $this->classmate_infos->getIterator();
        $iterator->uasort(function ($first, $second) {
            /** @var ClassmateInfo $first */
            /** @var ClassmateInfo $second */
            return (int) $first->getClassmateYear()->getReunionYear() > (int) $second->getClassmateYear()->getReunionYear() ? 1 : -1;
        });
        return new ArrayCollection(iterator_to_array($iterator));
    }

    /**
     * @param ClassmateInfo $classmate_info
     * @return Classmate
     */
    public function addClassmateInfo(ClassmateInfo $classmate_info): self
    {
        if (!$this->classmate_infos->contains($classmate_info)) {
            $this->classmate_infos[] = $classmate_info;
            $classmate_info->setClassmate($this);
        }

        return $this;
    }

    /**
     * @param ClassmateInfo $classmate_info
     * @return Classmate
     */
    public function removeClassmateInfo(ClassmateInfo $classmate_info): self
    {
        if ($this->classmate_infos->contains($classmate_info)) {
            $this->classmate_infos->removeElement($classmate_info);
            // set the owning side to null (unless already changed)
            if ($classmate_info->getClassmate() === $this) {
                $classmate_info->setClassmate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClassmateAttendance[]
     */
    public function getClassmateAttendances(): Collection
    {
        return $this->classmate_attendances;
    }

    /**
     * @param ClassmateAttendance $classmateAttendance
     * @return Classmate
     */
    public function addClassmateAttendance(ClassmateAttendance $classmateAttendance): self
    {
        if (!$this->classmate_attendances->contains($classmateAttendance)) {
            $this->classmate_attendances[] = $classmateAttendance;
            $classmateAttendance->setClassmate($this);
        }

        return $this;
    }

    /**
     * @param ClassmateAttendance $classmateAttendance
     * @return Classmate
     */
    public function removeClassmateAttendance(ClassmateAttendance $classmateAttendance): self
    {
        if ($this->classmate_attendances->contains($classmateAttendance)) {
            $this->classmate_attendances->removeElement($classmateAttendance);
            // set the owning side to null (unless already changed)
            if ($classmateAttendance->getClassmate() === $this) {
                $classmateAttendance->setClassmate(null);
            }
        }

        return $this;
    }

    public function getIsMissing(): ?string
    {
        return $this->is_missing;
    }

    public function setIsMissing(string $is_missing): self
    {
        $this->is_missing = $is_missing;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setClassmate($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getClassmate() === $this) {
                $contact->setClassmate(null);
            }
        }

        return $this;
    }

    public function getIsDeceased(): ?bool
    {
        return $this->is_deceased;
    }

    public function setIsDeceased(bool $is_deceased): self
    {
        $this->is_deceased = $is_deceased;

        return $this;
    }
}
