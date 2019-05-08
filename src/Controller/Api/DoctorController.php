<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Service\DoctorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/api/doctor")
 */
class DoctorController extends AbstractController
{
    /**
     * @Route("/", name="api_doctor_info", methods={"GET"})
     *
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     */
    public function doctorInfo(NormalizerInterface $normalizer)
    {
        return new JsonResponse($normalizer->normalize([
            'user' => $this->getUser()
        ]), Response::HTTP_OK);
    }

    /**
     * @Route("/save-patient", name="api_doctor_add_patient", methods={"POST"})
     * @param Request $request
     * @param DoctorService $doctorService
     * @return JsonResponse
     */
    public function savePatient(Request $request, DoctorService $doctorService)
    {
        return $doctorService->savePatient($request->getContent());
    }

    /**
     * @Route("/all-patients/{page}", requirements={"page"="\d+"}, name="api_all_patients", methods={"GET"})
     * @param DoctorService $doctorService
     * @param $page
     * @param NormalizerInterface $normalizer
     * @return JsonResponse
     */
    public function allPatients($page, DoctorService $doctorService, NormalizerInterface $normalizer)
    {
        $patients = $doctorService->getAllPatients($page);

        return new JsonResponse($normalizer->normalize([
            'patients' => $patients
        ], 'json', ['patients' => true]), Response::HTTP_OK);
    }

    /**
     * @Route("/search-patients", name="api_search_patients", methods={"GET"})
     *
     * @param Request $request
     * @param DoctorService $doctorService
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     */
    public function patientsSearch(Request $request, DoctorService $doctorService, NormalizerInterface $normalizer)
    {
        $patients = $doctorService->patientsSearch($request->get('query'));

        return new JsonResponse($normalizer->normalize([
            'patients' => $patients
        ], 'json', ['patients' => true]), Response::HTTP_OK);
    }

    /**
     * @Route("/add-patient/{id}", requirements={"page"="\d+"}, name="api_add_patient", methods={"POST"})
     *
     * @param User $patient
     * @param DoctorService $doctorService
     *
     * @return JsonResponse
     */
    public function addPatient(User $patient, DoctorService $doctorService)
    {
        return $doctorService->addPatient($patient, $this->getUser());
    }

    /**
     * @Route("/patients/{id}", requirements={"page"="\d+"}, name="api_single_patient", methods={"GET"})
     *
     * @param User $patient
     * @param NormalizerInterface $normalizer
     *
     * @return JsonResponse
     */
    public function singlePatient(User $patient, NormalizerInterface $normalizer)
    {
        return new JsonResponse($normalizer->normalize([
            'patient' => $patient
        ], 'json', ['patients' => true]));
    }
}