<?php declare(strict_types=1);

namespace App\Domain\Model;

class User
{
    private $id;
    public $attributes = [];

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

}
