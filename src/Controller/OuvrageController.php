<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ouvrage;
use App\Form\OuvrageType;
use App\Services\ShowOuvrage;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Tests\Compiler\G;

class OuvrageController extends AbstractController
{
    /**
     * @Route("/ouvrage", name="ouvrage")
     */
    public function index()
    {
        return $this->render('ouvrage/index.html.twig', [
            'controller_name' => 'OuvrageController',
        ]);
    }


 /**
     * @Route("/ouvrage", name="ouvrage")
     */
    public function create(Request $request)

    { $em=$this->getDoctrine()->getManager();
        $ouvrage= new Ouvrage();
    $form =$this->createForm(OuvrageType::class,$ouvrage);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($ouvrage);
            $em->flush();

        }
        return $this->render('ouvrage/create.html.twig' ,['form'=>$form->createView()] ) ;
    }

  /**
     * @Route("/listeOuvrage", name="liste_ouvrage")
     */
    public function showClasse(ShowOuvrage $ouvrage)
    {
        $res = $ouvrage->showOuvrage();
        return $this->render('ouvrage/listeOuvrage.html.twig', ['ouvrages' => $res]);
    }

   /**
     * @Route("/ouvrage/delete/{id}", name="ouvrage_delete")
     * Method ({"DELETE"})
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ouvrage = $em->getRepository(Ouvrage::class)->find($id);
        $em->remove($ouvrage);
        $em->flush();
        return $this->redirectToRoute('liste_ouvrage');
    }

  /**
     * @Route ("/ouvrage/update/{id}", name="update_ouvrage")
     * Method ({"GET", "POST"})
     */
    public function editerOuvrage(Request $request, Ouvrage $ouvrage, $id)
    {
        $form = $this->createForm(OuvrageType::class, $ouvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_ouvrage');
        }

        return $this->render('ouvrage/Editer.html.twig', [
            'ouvrages' => $ouvrage,
            'form' => $form->createView(),
        ]);
    }





}
