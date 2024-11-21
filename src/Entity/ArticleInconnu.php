<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Core\attributes\Table;
use Core\attributes\TargetRepository;


class ArticleInconnu
{
    private int $id;

    private string $name;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }  public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}