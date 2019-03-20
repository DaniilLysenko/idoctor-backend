<?php
namespace App\Service;

use App\Entity\Doctor;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DoctorService
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
        /** @var Doctor $doctor */
        $doctor = $this->doctrine->getRepository(Doctor::class)->findOneBy(['email' => $email]);

        if (!$doctor) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        if (!$this->checkPassword($password, $doctor)) {
            return new JsonResponse(['error' => 'Wrong password'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($this->normalizer->normalize([
            'user' => $doctor
        ]), Response::HTTP_OK);
    }

    /**
     * @param $password
     * @param Doctor $doctor
     * @return bool
     */
    private function checkPassword($password, Doctor $doctor)
    {
        return $this->passwordEncoder->isPasswordValid($doctor, $password);
    }
}