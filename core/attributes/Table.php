<?php

namespace Core\attributes;

use Attribute;

#[Attribute]
class Table
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

}