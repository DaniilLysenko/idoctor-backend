<?php

namespace App\Controller\Api;

use App\Entity\Hospital;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/api")
 */
class HospitalController extends AbstractController
{
    /**
     * @Route("/hospitals", name="api_hospitals", methods={"GET"})
     * @return JsonResponse
     */
    public function hospitals(NormalizerInterface $normalizer)
    {
        $hospitals = $this->getDoctrine()->getRepository(Hospital::class)->findAll();

        return new JsonResponse($normalizer->normalize([
            'hospitals' => $hospitals
        ]), Response::HTTP_OK);
    }
}