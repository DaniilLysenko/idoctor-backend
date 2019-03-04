<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var NormalizerInterface
     */
    private $normalizer;

    /**
     * UserService constructor.
     * @param RegistryInterface $doctrine
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param NormalizerInterface $normalizer
     */
    public function __construct(RegistryInterface $doctrine, UserPasswordEncoderInterface $passwordEncoder, NormalizerInterface $normalizer)
    {
        $this->doctrine = $doctrine;
        $this->passwordEncoder = $passwordEncoder;
        $this->normalizer = $normalizer;
    }

    /**
     * @param $email
     * @param $password
     * @return JsonResponse
     */
    public function login($email, $password) {
        /** @var User $user */
        $user = $this->doctrine->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        if (!$this->checkPassword($password, $user)) {
            return new JsonResponse(['error' => 'Wrong password'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($this->normalizer->normalize([
            'user' => $user
        ]), Response::HTTP_OK);
    }

    /**
     * @param $password
     * @param User $user
     * @return bool
     */
    private function checkPassword($password, User $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $password);
    }
}