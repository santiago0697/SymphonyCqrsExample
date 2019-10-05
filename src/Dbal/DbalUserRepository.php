<?php

namespace App\Dbal;

use App\Domain\Exception\EntityNotFoundException;
use App\Domain\Model\User;
use App\Domain\Repository\UserRepository;
use Doctrine\DBAL\Connection;

class DbalUserRepository implements UserRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findUserById(string $id): User
    {
        $query = $this->connection->createQueryBuilder();
        $query->select('*')
            ->from('users', 'u')
            ->where('u.id = :id')
            ->setParameter(':id', $id)
        ;
        $result = $query->execute()->fetchAll();
        if (empty($result)) {
            throw new EntityNotFoundException();
        }
        $user = new User($result[0]['id']);
        $user->setName($result[0]['name']);

        return $user;
    }

    public function putUser(User $user): void
    {
        $query = $this->connection->createQueryBuilder();
        $params = [
            'id' => '?',
            'name' => '?',
        ];

        try {
            $this->findUserById($user->getId());
            $query->update('users u')
                ->set('u.name', ':name')
                ->where('u.id = :id')
                ->setParameter('name', $user->getName())
                ->setParameter('id', $user->getId())
                ->execute()
                ;
        } catch (EntityNotFoundException $e) {
            $query->insert('users')
                ->values($params)->setParameters([
                    $user->getId(),
                    $user->getName(),
                ])->execute();
        }
    }

    public function deleteUser(string $id): void
    {
        $qb = $this->connection->createQueryBuilder();

        $qb->delete('users')
            ->where('id = :id')
            ->setParameter(':id', $id)
            ->execute()
        ;
    }
}
