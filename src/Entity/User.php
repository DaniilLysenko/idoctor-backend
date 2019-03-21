<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     errorPath="email",
 *     message="User with this email already exists"
 * )
 */
class User implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';

    use CreateUpdateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Firstname can't be blank")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Lastname can't be blank")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Patron name can't be blank")
     */
    private $patronName;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Birthday can't be blank")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Email is invalid")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 6,
     *     max = 20,
     *     minMessage = "Your password must be at least {{ limit }} characters long",
     *     maxMessage = "Your password cannot be longer than {{ limit }} characters")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apiKey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="users")
     */
    private $hospital;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\NotBlank(message="Street can't be blank")
     */
    private $street;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Street number can't be blank")
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $apartmentNumber;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->apiKey = Uuid::uuid4();
        $this->role = self::ROLE_USER;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPatronName(): ?string
    {
        return $this->patronName;
    }

    public function setPatronName(string $patronName): self
    {
        $this->patronName = $patronName;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSalt(){}

    public function getUsername(){}

    public function eraseCredentials(){}

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

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

    public function getApartmentNumber(): ?string
    {
        return $this->apartmentNumber;
    }

    public function setApartmentNumber(string $apartmentNumber): self
    {
        $this->apartmentNumber = $apartmentNumber;

        return $this;
    }
}
