<?php

namespace App\Normalizer;

use App\Entity\Doctor;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DoctorNormalizer implements NormalizerInterface
{
    /**
     * @param Doctor $object
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
     * @param null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Doctor;
    }
}