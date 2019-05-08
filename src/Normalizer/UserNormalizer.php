<?php

namespace App\Normalizer;

use App\Entity\Hospital;
use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var DoctorNormalizer
     */
    private $doctorNormalizer;

    /**
     * UserNormalizer constructor.
     * @param RegistryInterface $doctrine
     * @param DoctorNormalizer $doctorNormalizer
     */
    public function __construct(RegistryInterface $doctrine, DoctorNormalizer $doctorNormalizer)
    {
        $this->doctrine = $doctrine;
        $this->doctorNormalizer = $doctorNormalizer;
    }

    /**
     * @param User $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $response = [
            'id' => $object->getId()
        ];

        if (isset($context['login'])) {
            $response['apiKey'] = $object->getApiKey();
            $response['role'] = $object->getRole();
        }

        if (isset($context['patients'])) {
            $response['firstName'] = $object->getFirstName();
            $response['lastName'] = $object->getLastName();
            $response['patronName'] = $object->getPatronName();
            $response['email'] = $object->getEmail();
            $response['doctor'] = $object->getDoctor() === null ? null : $this->doctorNormalizer->normalize(
                $object->getDoctor(),
                'json',
                ['patientFetch' => true]
            );
        }

        return $response;
    }

    /**
     * @param mixed $data
     * @param string $class
     * @param null $format
     * @param array $context
     * @return User|object
     * @throws \Exception
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $user = new User();

        if (isset($data['firstName'])) {
            $user->setFirstName($data['firstName']);
        }

        if (isset($data['lastName'])) {
            $user->setLastName($data['lastName']);
        }

        if (isset($data['patronName'])) {
            $user->setPatronName($data['patronName']);
        }

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        if (isset($data['street'])) {
            $user->setStreet($data['street']);
        }

        if (isset($data['streetNumber'])) {
            $user->setStreetNumber($data['streetNumber']);
        }

        if (isset($data['apartmentNumber']) && $data['apartmentNumber'] !== '') {
            $user->setApartmentNumber($data['apartmentNumber']);
        }

        if (isset($data['hospital'])) {
            if (isset($data['hospital']['id'])) {
                $hospital = $this->doctrine->getRepository(Hospital::class)->find($data['hospital']['id']);

                if ($hospital) {
                    $user->setHospital($hospital);
                }
            }
        }

        return $user;
    }

    /**
     * @param mixed $data
     * @param null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param null $format
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return User::class === $type;
    }

}