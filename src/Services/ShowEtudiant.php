<?php


namespace App\Services;


use App\Repository\EtudiantRepository;
use App\Entity\Etudiant;

class ShowEtudiant
{
 protected $repo ;

 public function __construct(EtudiantRepository $repo)
 {
     $this->repo = $repo;
 }

    public function  ShowEtudiant() {

       return $this->repo->findAll() ;
    }
}