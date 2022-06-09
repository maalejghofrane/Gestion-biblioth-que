<?php


namespace App\Services;


use App\Repository\OuvrageRepository;

class ShowOuvrage
{
    protected $repo ;

    public function __construct(OuvrageRepository $repo)
    {
        $this->repo = $repo;
    }

    public function  showOuvrage() {

        return $this->repo->findAll() ;
    }
}