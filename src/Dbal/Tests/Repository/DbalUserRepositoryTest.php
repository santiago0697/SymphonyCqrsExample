<?php

namespace App\Dbal\Tests\Repository;

use App\Dbal\DbalUserRepository;
use App\Domain\Repository\UserRepository;
use App\Domain\Tests\Repository\UserRepositoryTest;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

/**
 * @internal
 * @coversNothing
 */
class DbalUserRepositoryTest extends UserRepositoryTest
{
    public function getRepository(): UserRepository
    {
        $config = new Configuration();
        $connectionParams = [
            'user' => 'root',
            'password' => 'root',
            'driver' => 'pdo_sqlite',
            //'memory' => true,
            'path' => '/tmp/sqlite_'.rand(0, 1000),
        ];
        $conn = DriverManager::getConnection($connectionParams, $config);
        $sm = $conn->getSchemaManager();
        $schema = $sm->createSchema();

        $table = $schema->createTable('users');
        $table->addColumn('id', 'string');
        $table->addColumn('name', 'string');
        $table->setPrimaryKey(['id']);

        $sqls = $schema->toSql($conn->getDatabasePlatform());

        foreach ($sqls as $sql) {
            $conn->executeQuery($sql);
        }

        return new DbalUserRepository($conn);
    }
}
