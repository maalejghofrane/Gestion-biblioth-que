<?php


namespace App\Services;


use App\Repository\ArticleRepository;
use App\Entity\Article;

class ShowArticle
{
 protected $repo ;

 public function __construct(ArticleRepository $repo)
 {
     $this->repo = $repo;
 }

    public function  ShowArticle() {

       return $this->repo->findAll() ;
    }
}