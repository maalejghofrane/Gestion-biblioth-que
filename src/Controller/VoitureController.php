<?php

namespace App\Controller;

use App\Services\ShowVoiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture")
     */
    public function index()
    {
        return $this->render('voiture/index.html.twig', [
            'controller_name' => 'VoitureController',
        ]);
    }
    /**
     * @Route("/voitures", name="show_voiture")
     */

    public function  ShowVoiture( ShowVoiture $service){
        $res=$service->ShowVoiture() ;
        return  $this->render('voiture/voiture',['voitures'=>$res]);
    }
}
