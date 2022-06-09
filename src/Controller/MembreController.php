<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use App\Services\ShowArticle;
use App\Services\ShowMembre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    /**
     * @Route("/membre", name="membre")
     */
    public function ShowMembree(ShowMembre $service)
    {
        $ress=$service->ShowMembre();

        return $this->render('membre/show', ['membres'=>$ress ]);

    }

    /**
     * @Route("/membre/{group}", name="membreById")
     */
    public function ShowMembreByGroup(Groupe $group,ShowMembre $service)
    {
        $ress=$service->ShowMembre($group);

        return $this->render('membre/show', ['membres'=>$ress]);

    }



    /**
     * @Route("/formMembre", name="formMembre")
     */

    public  function  create (Request $request) {
        $em=$this->getDoctrine()->getManager();
        $membre= new Membre();
        $form =$this->createForm(MembreType::class,$membre);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($membre);
            $em->flush();
        }
        return $this->render('membre/index.html.twig' ,['form'=>$form->createView()] ) ;
    }
}


