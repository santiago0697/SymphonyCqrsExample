<?php

declare(strict_types=1);

namespace App\Domain\Model;

class User
{
    public $attributes = [];
    private $id;
    private $name;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}
