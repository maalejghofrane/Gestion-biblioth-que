<?php


namespace App\Services;


use App\Entity\Groupe;
use App\Entity\Membre;
use App\Repository\ArticleRepository;
use App\Repository\MembreRepository;

class ShowMembre
{

    protected $repo1 ;

    public function __construct(MembreRepository $repo1)
    {
        $this->repo1 = $repo1;
    }


    public function  ShowMembre(Groupe $groupe=null) {

        return $this->repo1->searchMembersByGroup($groupe) ;

    }
}