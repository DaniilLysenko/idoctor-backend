<?php

namespace App\Normalizer;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param User $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $response = [
            'id' => $object->getId(),
            'apiKey' => $object->getApiKey(),
            'role' => $object->getRole()
        ];

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

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
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