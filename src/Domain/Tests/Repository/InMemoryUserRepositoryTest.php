<?php

namespace App\Domain\Tests\Repository;

use App\Domain\Repository\UserRepository;
use App\Domain\Tests\Repository\UserRepositoryTest;
use App\Domain\Repository\InMemoryUserRepository;

class InMemoryUserRepositoryTest extends UserRepositoryTest
{
    function getRepository() : UserRepository {
        return new InMemoryUserRepository();
    }
}