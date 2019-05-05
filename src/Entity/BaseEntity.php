<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="delete_date_time", timeAware=false)
 */
abstract class BaseEntity {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $created_by;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $updated_by;

    /**
     * @ORM\Column(type="datetime", name="delete_date_time", nullable=true)
     */
    private $delete_date_time;

    /**
     * @ORM\PrePersist()
     */
    public function preUpdate() {
        if (empty($this->created_date)) {
            $this->created_date = new DateTime();
        }
        if (empty($this->updated_date)) {
            $this->updated_date = new DateTime();
        }
        if (empty($this->updated_by)) {
            $this->updated_by = 'anon';
        }
        if (empty($this->created_by)) {
            $this->created_by = 'anon';
        }
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BaseEntity
     */
    protected function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param DateTime $createdDate
     * @return BaseEntity
     */
    public function setCreatedDate($createdDate): self
    {
        $this->created_date = $createdDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate(): ?DateTime
    {
        return $this->created_date;
    }

    /**
     * @param DateTime $updated_date
     * @return BaseEntity
     */
    public function setUpdatedDate($updated_date): self
    {
        $this->updated_date = $updated_date;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedDate(): ?DateTime
    {
        return $this->updated_date;
    }

    /**
     * @param string $createdBy
     * @return BaseEntity
     */
    public function setCreatedBy($createdBy): self
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    /**
     * @param string $updatedBy
     * @return BaseEntity
     */
    public function setUpdatedBy($updatedBy): self
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    /**
     * @param DateTime $delete_date_time
     *
     * @return BaseEntity
     */
    public function setDeleteDateTime($delete_date_time): self
    {
        $this->delete_date_time = $delete_date_time;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeleteDateTime(): ?DateTime
    {
        return $this->delete_date_time;
    }
}
