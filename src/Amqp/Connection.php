<?php

namespace App\Amqp;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection
{
    private $connection;

    public function getConnection(): AMQPStreamConnection
    {
        if ($this->connection instanceof AMQPStreamConnection) {
            return $this->connection;
        }
        $this->connection = new AMQPStreamConnection(
            '127.0.0.1',
            '5672',
            'guest',
            'guest'
        );

        return $this->connection;
    }
}
