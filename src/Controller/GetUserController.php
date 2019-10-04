<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use League\Tactician\CommandBus;

class GetUserController 
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
        die("HEY");
    }
}

