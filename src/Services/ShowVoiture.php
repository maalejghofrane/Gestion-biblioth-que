<?php


namespace App\Services;


use App\Repository\VoitureRepository;

class ShowVoiture
{
    protected $repo ;

    public function __construct(VoitureRepository $repo)
    {
        $this->repo = $repo;
    }

    public function  ShowVoiture() {

        return $this->repo->findAll() ;
    }
}