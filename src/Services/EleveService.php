<?php


namespace App\Services;


use App\Entity\Classe;
use App\Repository\EleveRepository;

class EleveService
{



    protected $repo ;

    public function __construct(EleveRepository $repo)
    {
        $this->repo1 = $repo;
    }




    public function  showEleve(Classe $classe=null) {

        return $this->repo1->searchElevesByclasse($classe) ;

    }

    public function findfName($id)
    {
        return $this->repo->GetName($id);
    }
}