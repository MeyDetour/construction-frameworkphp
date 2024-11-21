<?php

namespace App\Repository;

use App\Entity\Article;
use Core\attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(name: Article::class)]
class ArticleRepository extends Repository
{

}