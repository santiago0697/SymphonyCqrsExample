<?php

namespace App\Domain\Command;

use App\Domain\Model\User;

class PutUser
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
}
