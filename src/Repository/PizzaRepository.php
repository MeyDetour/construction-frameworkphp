<?php

namespace App\Repository;

use App\Entity\Pizza;
use Core\attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(name: Pizza::class)]
class PizzaRepository extends Repository
{

}