<?php

namespace App\Domain\QueryHandler;

use App\Domain\Query\GetUser;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepository;

class GetUserHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUser $getUser)
    {
        return $this
                ->userRepository
                ->findUserById($getUser->getId());
    }
}
