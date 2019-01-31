<?php

namespace App\Entity\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class LoginDto
{
    /**
     * @Assert\Email
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 6,
     *     max = 20,
     *     minMessage = "Your password must be at least {{ limit }} characters long",
     *     maxMessage = "Your password cannot be longer than {{ limit }} characters")
     */
    private $password;

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
}