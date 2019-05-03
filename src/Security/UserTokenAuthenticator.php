<?php

namespace App\Security;

use App\Service\UserService;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserTokenAuthenticator extends BaseAuthenticator
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * TokenAuthenticator constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return UserInterface|void|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiToken = $credentials['token'];

        return $this->userService->getUser($apiToken);
    }
}