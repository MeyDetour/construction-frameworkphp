<?php

namespace Core\attributes;
#[\Attribute]
class TargetRepository
{
    private $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }


}