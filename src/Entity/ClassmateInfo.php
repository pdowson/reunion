<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassmateInfoRepository")
 * @Vich\Uploadable
 */
class ClassmateInfo extends BaseEntity
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo_url;

    /**
     * @Vich\UploadableField(mapping="photo_url", fileNameProperty="photo_url")
     * @var File
     */
    private $photo_file;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info_string;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classmate", inversedBy="classmate_infos")
     */
    private $classmate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassmateYear", inversedBy="classmate_info")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classmate_year;

    public function __toString()
    {
        return
            $this->getClassmate()->__toString() . " - " .
            $this->getClassmateYear()->getReunionYear() . " - " .
            ($this->getPhotoUrl() ? "Has Photo" : "No Photo") . " - " .
            ($this->getEmail() ? "Has Email" : "No Email") . " - " .
            ($this->getInfoString() ? "Has Info" : "No Info");
    }

    public function getPhotoUrl()
    {
        return $this->photo_url;
    }

    public function setPhotoUrl(?string $photo_url = null)
    {
        $this->photo_url = $photo_url;

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

    /**
     * @return File
     */
    public function getPhotoFile()
    {
        return $this->photo_file;
    }

    /**
     * @param File $photo_file
     * @throws
     */
    public function setPhotoFile(File $photo_file = null)
    {
        $this->photo_file = $photo_file;
        if ($photo_file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedDate(new \DateTime('now'));
        }
    }

}
