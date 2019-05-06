<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalCardRecordRepository")
 */
class MedicalCardRecord
{
    use CreateUpdateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MedicalCard", inversedBy="records")
     */
    private $medicalCard;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor", inversedBy="medicalCardRecords")
     */
    private $doctor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalCard(): ?MedicalCard
    {
        return $this->medicalCard;
    }

    public function setMedicalCard(?MedicalCard $medicalCard): self
    {
        $this->medicalCard = $medicalCard;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
