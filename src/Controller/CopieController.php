<?php

namespace App\Controller;
use App\Entity\Ouvrage;
use App\Entity\Copie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CopieType;
use App\Repository\CopieRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Services\CopieService;

class CopieController extends AbstractController
{
    /**
     * @Route("/copie", name="copie")
     */
    public function index()
    {
        return $this->render('copie/index.html.twig', [
            'controller_name' => 'CopieController',
        ]);
    }

      /**
     * @Route("/copie", name="copie")
     */
    public  function  create (Request $request) {
        $em=$this->getDoctrine()->getManager();
        $copie= new Copie();
        $form =$this->createForm(CopieType::class,$copie);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($copie);
            $em->flush();
        }
        return $this->render('copie/createCopie.html.twig' ,['form'=>$form->createView()] ) ;
    }
    
  /**
     * @Route("/copie/{ouvrage}", name="copieById")
     */
    public function showCopieByOuvrage(Ouvrage $ouvrage,CopieService $service)
    {
        $res=$service->showCopie($ouvrage);

        return $this->render('copie/show.html.twig', ['copies'=>$res]);

    }

    /**
     * @Route ("/copie/update/{id}", name="update_copie")
     * Method ({"GET", "POST"})
     */
    public function editerClasse(Request $request, Copie $copie, $id)
    {
        $form = $this->createForm(CopieType::class, $copie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_ouvrage');
        }

        return $this->render('copie/update.html.twig', [
            'copies' => $copie,
            'form' => $form->createView(),
        ]);
    }

  /**
     * @Route("/copie/delete/{id}", name="copieedelete")
     * Method ({"DELETE"})
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $copie = $em->getRepository(Copie::class)->find($id);
        $em->remove($copie);
        $em->flush();
        return $this->redirectToRoute('liste_ouvrage');
    }


}
