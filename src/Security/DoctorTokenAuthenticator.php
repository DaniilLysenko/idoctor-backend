<?php

namespace App\Security;

use App\Service\DoctorService;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DoctorTokenAuthenticator extends BaseAuthenticator
{
    /**
     * @var DoctorService
     */
    private $doctorService;

    /**
     * TokenAuthenticator constructor.
     * @param DoctorService $doctorService
     */
    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return UserInterface|void|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiToken = $credentials['token'];

        return $this->doctorService->getDoctor($apiToken);
    }
}