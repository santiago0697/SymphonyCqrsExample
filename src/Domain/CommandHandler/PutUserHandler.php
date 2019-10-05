<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\PutUser;
use App\Domain\Repository\UserRepository;

class PutUserHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(PutUser $putUser)
    {
        $this->userRepository->putUser($putUser->getUser());
    }
}
