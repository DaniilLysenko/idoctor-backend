<?php

namespace App\Normalizer;

use App\Entity\Announcement;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AnnouncementNormalizer implements NormalizerInterface
{
    /**
     * @param Announcement $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $response = [
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'description' => $object->getDescription(),
            'image' => $object->getImage()
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
        return $data instanceof Announcement;
    }
}