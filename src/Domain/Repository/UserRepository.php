<?php
namespace App\Domain\Repository;

use App\Domain\Model\User;
use App\Domain\Exception\EntityNotFoundException;

interface UserRepository {
    /**
     * @throws EntityNotFoundException
     */
    public function findUserById(string $id): User;

    public function putUser(User $user): void;

    public function deleteUser(string $id): void;
}