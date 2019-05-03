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
     * @Route("/all-patients/{page}", requirements={"page"="\d+"}, name="api_all_patients", methods={"GET"})
     * @param DoctorService $doctorService
     * @param $page
     * @return JsonResponse
     */
    public function allPatients(DoctorService $doctorService, $page)
    {
        $patients = $doctorService->getAllPatients($page);

        return new JsonResponse();
    }
}