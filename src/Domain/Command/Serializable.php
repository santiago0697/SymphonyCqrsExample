<?php

namespace App\Domain\Command;

interface Serializable
{
    public function toArray(): array;

    public static function fromArray(array $array);
}
