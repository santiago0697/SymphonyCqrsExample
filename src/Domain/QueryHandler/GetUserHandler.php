<?php

namespace App\Domain\QueryHandler;

use App\Domain\Query\GetUser;
use App\Domain\Model\User;

class GetUserHandler
{
    public function handle(GetUser $getUser)
    {
       return new User($getUser->getId());
    }
}
