<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function login(Request $request)
    {

    }
}