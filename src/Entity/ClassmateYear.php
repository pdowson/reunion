<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassmateYearRepository")
 * @Vich\Uploadable
 */
class ClassmateYear extends BaseEntity
{
    /**
     * @ORM\Column(type="integer")
     */
    private $reunion_year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reunion_photo_url;

    /**
     * @Vich\UploadableField(mapping="reunion_photo_url", fileNameProperty="reunion_photo_url")
     * @var File
     */
    private $reunion_photo_file;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reunion_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassmateAddress", mappedBy="classmate_year", orphanRemoval=true)
     */
    private $classmate_address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassmateAttendance", mappedBy="classmate_year", orphanRemoval=true)
     */
    private $classmate_attendance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassmateInfo", mappedBy="classmate_year", orphanRemoval=true)
     */
    private $classmate_info;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="classmate_year")
     */
    private $contacts;

    public function __construct()
    {
        $this->classmate_address = new ArrayCollection();
        $this->classmate_attendance = new ArrayCollection();
        $this->classmate_info = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getReunionYear();
    }

    public function getReunionYear(): ?string
    {
        return $this->reunion_year;
    }

    public function setReunionYear(int $reunion_year): self
    {
        $this->reunion_year = $reunion_year;

        return $this;
    }

    public function getReunionPhotoUrl()
    {
        return $this->reunion_photo_url;
    }

    public function setReunionPhotoUrl(string $reunion_photo_url = null)
    {
        $this->reunion_photo_url = $reunion_photo_url;

        return $this;
    }

    public function getReunionDate()
    {
        return $this->reunion_date;
    }

    public function setReunionDate(DateTimeInterface $reunion_date = null)
    {
        $this->reunion_date = $reunion_date;

        return $this;
    }

    /**
     * @return Collection|ClassmateAddress[]
     */
    public function getClassmateAddress(): Collection
    {
        return $this->classmate_address;
    }

    public function addClassmateAddress(ClassmateAddress $classmateAddress): self
    {
        if (!$this->classmate_address->contains($classmateAddress)) {
            $this->classmate_address[] = $classmateAddress;
            $classmateAddress->setClassmateYear($this);
        }

        return $this;
    }

    public function removeClassmateAddress(ClassmateAddress $classmateAddress): self
    {
        if ($this->classmate_address->contains($classmateAddress)) {
            $this->classmate_address->removeElement($classmateAddress);
            // set the owning side to null (unless already changed)
            if ($classmateAddress->getClassmateYear() === $this) {
                $classmateAddress->setClassmateYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClassmateAttendance[]
     */
    public function getClassmateAttendance(): Collection
    {
        return $this->classmate_attendance;
    }

    public function addClassmateAttendance(ClassmateAttendance $classmateAttendance): self
    {
        if (!$this->classmate_attendance->contains($classmateAttendance)) {
            $this->classmate_attendance[] = $classmateAttendance;
            $classmateAttendance->setClassmateYear($this);
        }

        return $this;
    }

    public function removeClassmateAttendance(ClassmateAttendance $classmateAttendance): self
    {
        if ($this->classmate_attendance->contains($classmateAttendance)) {
            $this->classmate_attendance->removeElement($classmateAttendance);
            // set the owning side to null (unless already changed)
            if ($classmateAttendance->getClassmateYear() === $this) {
                $classmateAttendance->setClassmateYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClassmateInfo[]
     */
    public function getClassmateInfo(): Collection
    {
        return $this->classmate_info;
    }

    public function addClassmateInfo(ClassmateInfo $classmateInfo): self
    {
        if (!$this->classmate_info->contains($classmateInfo)) {
            $this->classmate_info[] = $classmateInfo;
            $classmateInfo->setClassmateYear($this);
        }

        return $this;
    }

    public function removeClassmateInfo(ClassmateInfo $classmateInfo): self
    {
        if ($this->classmate_info->contains($classmateInfo)) {
            $this->classmate_info->removeElement($classmateInfo);
            // set the owning side to null (unless already changed)
            if ($classmateInfo->getClassmateYear() === $this) {
                $classmateInfo->setClassmateYear(null);
            }
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getReunionPhotoFile()
    {
        return $this->reunion_photo_file;
    }

    /**
     * @param File $reunion_photo_file
     * @throws
     */
    public function setReunionPhotoFile(File $reunion_photo_file = null)
    {
        $this->reunion_photo_file = $reunion_photo_file;
        if ($reunion_photo_file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedDate(new DateTime('now'));
        }
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
            $contact->setClassmateYear($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getClassmateYear() === $this) {
                $contact->setClassmateYear(null);
            }
        }

        return $this;
    }

}
