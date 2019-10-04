<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use League\Tactician\CommandBus;
use App\Domain\Query\GetUser;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserController 
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request)
    {
        $query = new GetUser($request->get('id'));
        $user = $this->commandBus->handle($query);
        return new JsonResponse([
            'id' => $user->getId(),
            'attr' => $user->attributes
        ]);
    }
}

