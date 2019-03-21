<?php

namespace App\Controller\Api;

use App\Service\DoctorService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Auth controller.
 * @Route("/api")
 */
class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="api_login", methods={"POST"})
     * @param Request $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function login(Request $request, UserService $userService)
    {
        $params = json_decode($request->getContent());

        return $userService->login($params->email, $params->password);
    }

    /**
     * @Route("/doctor/login", name="api_doctor_login", methods={"POST"})
     * @param Request $request
     * @param DoctorService $doctorService
     * @return JsonResponse
     */
    public function doctorLogin(Request $request, DoctorService $doctorService)
    {
        $params = json_decode($request->getContent());

        return $doctorService->login($params->email, $params->password);
    }
}