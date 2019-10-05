<?php

namespace App\Domain\Tests\Repository;

use App\Domain\Exception\EntityNotFoundException;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

abstract class UserRepositoryTest extends TestCase
{
    abstract public function getRepository(): UserRepository;

    public function testGetUser()
    {
        $repository = $this->getRepository();
        $user = new User('1');
        $user->setName('santi');
        $repository->putUser($user);
        $this->assertEquals($user, $repository->findUserById('1'));
    }

    public function testGetNotFoundUser()
    {
        $repository = $this->getRepository();
        $this->expectException(EntityNotFoundException::class);
        $repository->findUserById('1');
    }

    public function testGetNotFoundUser2()
    {
        $repository = $this->getRepository();
        $user = new User('1');
        $user->setName('santi');
        $repository->putUser($user);
        $this->expectException(EntityNotFoundException::class);
        $repository->findUserById('3');
    }

    public function testDeleteExistingUser()
    {
        $repository = $this->getRepository();
        $user = new User('1');
        $user->setName('santi');
        $repository->putUser($user);
        $repository->deleteUser('1');
        $this->expectException(EntityNotFoundException::class);
        $repository->findUserById('1');
    }

    public function testDeleteNonExistingUser()
    {
        $repository = $this->getRepository();
        $repository->deleteUser('1');
        $this->assertTrue(true);
    }
}
