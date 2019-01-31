<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $streetName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $homeNumber;

    public function __toString()
    {
        return $this->getRegion() . ', ' . $this->getCity() . ', ' . 'вул. ' .
            $this->getStreetName() . ' ' . $this->getStreetNumber() . ', ' . $this->getHomeNumber();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getHomeNumber(): ?string
    {
        return $this->homeNumber;
    }

    public function setHomeNumber(string $homeNumber): self
    {
        $this->homeNumber = $homeNumber;

        return $this;
    }
}
