<?php

namespace Core\attributes;

#[\Attribute]
class TargetEntity
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}