<?php

namespace App\Controller\Api;

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
        return $userService->login($request->get('email'), $request->get('password'));
    }
}