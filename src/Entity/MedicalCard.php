<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalCardRepository")
 */
class MedicalCard
{
    use CreateUpdateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="medicalCard", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MedicalCardRecord", mappedBy="medicalCard")
     */
    private $records;

    public function __construct()
    {
        $this->records = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?User
    {
        return $this->patient;
    }

    public function setPatient(?User $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection|MedicalCardRecord[]
     */
    public function getRecords(): Collection
    {
        return $this->records;
    }

    public function addRecord(MedicalCardRecord $record): self
    {
        if (!$this->records->contains($record)) {
            $this->records[] = $record;
            $record->setMedicalCard($this);
        }

        return $this;
    }

    public function removeRecord(MedicalCardRecord $record): self
    {
        if ($this->records->contains($record)) {
            $this->records->removeElement($record);
            // set the owning side to null (unless already changed)
            if ($record->getMedicalCard() === $this) {
                $record->setMedicalCard(null);
            }
        }

        return $this;
    }
}
