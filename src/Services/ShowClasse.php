<?php


namespace App\Services;


use App\Repository\ClasseRepository;

class ShowClasse
{
    protected $repo ;

    public function __construct(ClasseRepository $repo)
    {
        $this->repo = $repo;
    }

    public function  showClasse() {

        return $this->repo->findAll() ;
    }
}