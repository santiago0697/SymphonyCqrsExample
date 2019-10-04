<?php

namespace App\Domain\Query;

class GetUser 
{
    private $id; 

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
