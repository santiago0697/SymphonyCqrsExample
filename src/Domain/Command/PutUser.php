<?php

namespace App\Domain\Command;

use App\Domain\Model\User;

class PutUser implements Serializable
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->user->getId(),
            'name' => $this->user->getName(),
            'namespace' => get_class($this),
        ];
    }

    public static function fromArray(array $array)
    {
        $user = new User($array['id']);
        $user->setName($array['name']);

        return new PutUser($user);
    }
}
