<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/doctor")
 */
class DoctorController extends AbstractController
{
    /**
     * @Route("/add-patient", name="api_doctor_add_patient", methods={"POST"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function addPatient(Request $request, ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $content = $request->getContent();

//        TODO: add denormaliztion to user

        $user = $serializer->deserialize(
            $request->getContent(),
            User::class,
            'json'
        );

        return new JsonResponse(['message' => 'OK'], Response::HTTP_OK);
    }
}