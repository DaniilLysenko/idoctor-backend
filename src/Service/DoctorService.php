<?php
namespace App\Service;

use App\Entity\Doctor;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DoctorService extends DefaultService
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var NormalizerInterface
     */
    private $normalizer;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * UserService constructor.
     * @param RegistryInterface $doctrine
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param NormalizerInterface $normalizer
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        RegistryInterface $doctrine,
        UserPasswordEncoderInterface $passwordEncoder,
        NormalizerInterface $normalizer,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        PaginatorInterface $paginator)
    {
        parent::__construct($passwordEncoder);
        $this->doctrine = $doctrine;
        $this->normalizer = $normalizer;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->paginator = $paginator;
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
        ], 'json', ['login' => true]), Response::HTTP_OK);
    }

    /**
     * @param $content
     * @return JsonResponse
     */
    public function savePatient($content)
    {
        /** @var User $user */
        $user = $this->serializer->deserialize(
            $content,
            User::class,
            'json'
        );

        $errors = $this->validator->validate($user);

        if (count($errors)) {
            return new JsonResponse(['errors' => $this->getAllErrors($errors)['errors']], Response::HTTP_BAD_REQUEST);
        }

        $user->setPassword($this->encodePassword($user, $user->getPassword()));

        $this->doctrine->getManager()->persist($user);

        $this->doctrine->getManager()->flush();

        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }

    /**
     * @param $apiKey
     *
     * @return Doctor|object|null
     */
    public function getDoctor($apiKey)
    {
        $user = $this->doctrine->getRepository(Doctor::class)->findOneBy(['apiKey' => $apiKey]);

        return $user;
    }

    /**
     * @param $page
     *
     * @return PaginationInterface
     */
    public function getAllPatients($page)
    {
        $users = $this->doctrine->getRepository(User::class)->getAllPatients();

        $pagination = $this->paginator->paginate(
            $users,
            $page,
            30
        );

        return $pagination;
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function patientsSearch($query)
    {
        $patients = $this->doctrine->getRepository(User::class)->search($query);

        return $patients;
    }

    /**
     * @param User $user
     * @param Doctor $doctor
     *
     * @return JsonResponse
     */
    public function addPatient(User $user, Doctor $doctor)
    {
        if (!$user) {
            return new JsonResponse([
                'error' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $doctor->addPatient($user);
        $this->doctrine->getManager()->flush();

        return new JsonResponse([
            'message' => 'Patient added successfully'
        ], Response::HTTP_OK);
    }
}