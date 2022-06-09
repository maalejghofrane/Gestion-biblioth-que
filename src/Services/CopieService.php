<?php


namespace App\Services;


use App\Entity\Ouvrage;
use App\Repository\CopieRepository;

class CopieService
{
    protected $repo ;

    public function __construct(CopieRepository $repo)
    {
        $this->repo1 = $repo;
    }

    public function  showCopie(Ouvrage $ouvrage=null) {

        return $this->repo1->searchCopiesByouvrage($ouvrage) ;

    }

    public function findfName($id)
    {
        return $this->repo->GetName($id);
    }
}