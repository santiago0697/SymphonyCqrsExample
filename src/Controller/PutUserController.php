<?php

namespace App\Controller;

use App\Domain\Command\PutUser;
use App\Domain\Model\User;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PutUserController
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $user = new User($request->get('id'));
        $user->setName($data['name']);
        $this->commandBus->handle(new PutUser($user));

        return new JsonResponse([], 201);
    }
}
