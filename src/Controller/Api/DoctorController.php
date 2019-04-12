<?php

namespace App\Controller\Api;

use App\Service\DoctorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/doctor")
 */
class DoctorController extends AbstractController
{
    /**
     * @Route("/add-patient", name="api_doctor_add_patient", methods={"POST"})
     * @param Request $request
     * @param DoctorService $doctorService
     * @return JsonResponse
     */
    public function addPatient(Request $request, DoctorService $doctorService)
    {
        return $doctorService->addPatient($request->getContent());
    }

    /**
     * @Route("/test", name="testt", methods={"GET"})
     */
    public function gettt()
    {
        return new JsonResponse(['sadfd' => 'dsafsdf']);
    }
}