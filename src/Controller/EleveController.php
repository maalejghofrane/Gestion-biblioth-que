<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Eleve;
use App\Form\EleveType;
use App\Services\EleveService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
        /**
     * @Route("/eleve/delete/{id}", name="eleveeedelete")
     * Method ({"DELETE"})
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $eleve = $em->getRepository(Eleve::class)->find($id);
        $em->remove($eleve);
        $em->flush();
        return $this->redirectToRoute('liste_classe');
    }

    /**
     * @Route("/eleve", name="eleve")
     */
    public function index(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $eleve= new Eleve();
        $form =$this->createForm(EleveType::class,$eleve);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($eleve);
            $em->flush();
        }
        return $this->render('eleve/index.html.twig' ,['form'=>$form->createView()] ) ;
    }

    /**
     * @Route("/eleve/{classe}", name="eleveById")
     */
    public function showEleveByClasse(Classe $classe,EleveService $service)
    {
        $res=$service->showEleve($classe);

        return $this->render('eleve/show', ['eleves'=>$res]);

    }




    /**
     * @Route ("/eleve/update/{id}", name="update_eleve")
     * Method ({"GET", "POST"})
     */
    public function editerClasse(Request $request, Eleve $eleve, $id)
    {
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_classe');
        }

        return $this->render('eleve/update', [
            'eleves' => $eleve,
            'form' => $form->createView(),
        ]);
    }


}
