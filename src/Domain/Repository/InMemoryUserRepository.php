<?php

namespace App\Domain\Repository;

use App\Domain\Exception\EntityNotFoundException;
use App\Domain\Model\User;

class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    /**
     * @throws EntityNotFoundException
     */
    public function findUserById(string $id): User
    {
        if (!\array_key_exists($id, $this->users)) {
            throw new EntityNotFoundException();
        }

        return $this->users[$id];
    }

    public function putUser(User $user): void
    {
        $this->users[$user->getId()] = $user;
    }

    public function deleteUser(string $id): void
    {
        if (\array_key_exists($id, $this->users)) {
            unset($this->users[$id]);
        }
    }
}
