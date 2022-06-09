<?php

namespace App\Controller;

use App\Services\ShowEtudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtudiantRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use phpDocumentor\Reflection\Types\Integer;
use Twig\Test\IntegrationTestCase;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

    /**
    * @Route("/etudiants", name="show_etudiants")
    */

public function  ShowArticlee( ShowEtudiant $service){
    $res=$service->ShowEtudiant() ;
    return  $this->render('etudiant/showEtudiants.html.twig',['etudiants'=>$res]);
}

    /**
     * @Route("/etudiant/create",name="etudiant_create");
     */

    public function create(Request $request , ObjectManager $manager ) {
        $etudiant=new Etudiant();
        $form=$this->createFormBuilder($etudiant)
        ->add('cin',TextareaType::class,['attr'=>['placeholder'=>"Cin",'class'=>'form-control']])
        ->add('prenom',TextareaType::class,['attr'=>['placeholder'=>"Prenom",'class'=>'form-control']] )
        ->add('nom',TextareaType::class,['attr'=>['placeholder'=>"Nom",'class'=>'form-control']])
        ->add('cursus',TextareaType::class,['attr'=>['placeholder'=>"Cursus",'class'=>'form-control']])
        // ->add('save',SubmitType::class, ['label'=>'Enregistrer'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $etudiant->setCopies(0);
            $manager->persist(($etudiant));
            $manager->flush();
            $this->addFlash('success', 'Étudiant crée');
            return $this->redirectToRoute('show_etudiants',['id'=> $etudiant->getId()]);

        }
        return $this->render('etudiant/createEtudiant.html.twig',['formEtudiant'=>$form->createView()]);
    }

    /**
     * @Route("/etudiant/{id}", name="show_etudiant")
     */

    public function show(Etudiant $etudiant)
    {
        return $this->render('etudiant/showEtudiant.html.twig', ['etudiant' => $etudiant]);
    }

  /**
     * @Route("/etudiant/delete/{id}", name="etudiant_delete")
     * Method ({"DELETE"})
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $etudiant = $em->getRepository(Etudiant::class)->find($id);
        $em->remove($etudiant);
        $em->flush();
        return $this->redirectToRoute('show_etudiants');
    }

 /**
     * @Route ("/etudiant/update/{id}", name="update_etudiant")
     * Method ({"GET", "POST"})
     */
    public function editerEtudiant(Request $request, Etudiant $etudiant, $id)
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show_etudiants');
        }
        
        return $this->render('etudiant/editerEtudiant.html.twig', [
            'etudiants' => $etudiant,
            'form' => $form->createView(),
        ]);
    }
}



