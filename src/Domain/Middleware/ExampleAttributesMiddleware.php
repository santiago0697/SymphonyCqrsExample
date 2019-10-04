<?php
namespace App\Domain\Middleware;

use League\Tactician\Middleware;
use App\Domain\Query\GetUser;
use App\Domain\Model\User;

class ExampleAttributesMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        $result = $next($command);

        if($command instanceof GetUser && $result instanceof User){
            $result->attributes['injected'] = '12345';
        }
        return $result;
    }
}
