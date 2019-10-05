<?php

namespace App\Amqp\Console;

use App\Amqp\Connection;
use League\Tactician\CommandBus;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandConsumer extends Command
{
    private $connection;
    private $commandBus;

    public function __construct(Connection $connection, CommandBus $commandBus)
    {
        parent::__construct();
        $this->connection = $connection;
        $this->commandBus = $commandBus;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $channel = $this->connection->getConnection()->channel();
        $channel->basic_consume('commands', '', false, false, false, false, function (AMQPMessage $message) {
            $array = json_decode($message->body, true);
            $namespace = $array['namespace'];
            $command = $namespace::fromArray($array);
            $this->commandBus->handle($command);
            echo 'Command consumed'.PHP_EOL;
        });
        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
