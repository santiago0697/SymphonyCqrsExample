<?php

namespace App\Amqp\Middleware;

use App\Amqp\Connection;
use App\Domain\Command\Serializable;
use League\Tactician\Middleware;
use PhpAmqpLib\Message\AMQPMessage;

class AmqpMiddleware implements Middleware
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function execute($command, callable $next)
    {
        if ($command instanceof Serializable) {
            $channel = $this->connection->getConnection()->channel();
            $commandAsArray = $command->toArray();
            $channel->basic_publish(
                new AMQPMessage(json_encode($commandAsArray), ['delivery_mode' => 2]),
                '',
                'commands'
            );

            return;
        }

        return $next($command);
    }
}
