<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Core\attributes\Table;
use Core\attributes\TargetRepository;

#[Table(name: 'test')]
#[TargetRepository(name: PizzaRepository::class)]
class Pizza
{
private $id;
private $name;
}