<?php

namespace App\Normalizer;

use App\Entity\Hospital;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HospitalNormalizer implements NormalizerInterface
{
    /**
     * @param Hospital $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $response = [
            'id' => $object->getId(),
            'name' => $object->getName()
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
        return $data instanceof Hospital;
    }
}