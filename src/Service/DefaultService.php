<?php

namespace App\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class DefaultService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @return array
     */
    protected function getAllErrors(ConstraintViolationListInterface $errors)
    {
        $section = [];
        if (count($errors)) {
            $section['errors'] = array_map(
                function (ConstraintViolationInterface $error) {
                    return [
                        'message' => $error->getMessage()
                    ];
                },
                iterator_to_array($errors)
            );
        }

        return $section;
    }

    /**
     * @param $password
     * @param UserInterface $entity
     * @return bool
     */
    protected function checkPassword($password, UserInterface $entity)
    {
        return $this->passwordEncoder->isPasswordValid($entity, $password);
    }
}