<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctorRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     errorPath="email",
 *     message="User with this email already exists"
 * )
 */
class Doctor implements UserInterface
{
    const ROLE_DOCTOR = 'ROLE_DOCTOR';

    use CreateUpdateTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $patronName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hospital", inversedBy="doctors")
     */
    private $hospital;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="doctor")
     */
    private $patients;

    public function __construct()
    {
        $this->role = self::ROLE_DOCTOR;
        $this->patients = new ArrayCollection();
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

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(User $user): self
    {
        if (!$this->patients->contains($user)) {
            $this->patients[] = $user;
            $user->setDoctor($this);
        }

        return $this;
    }

    public function removePatient(User $user): self
    {
        if ($this->patients->contains($user)) {
            $this->patients->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getDoctor() === $this) {
                $user->setDoctor(null);
            }
        }

        return $this;
    }

    public function getSalt(){}

    public function getUsername(){}

    public function eraseCredentials(){}
}
