<?php

namespace App\Controller;

use App\Entity\Classe;

use App\Entity\Eleve;
use App\Form\ClasseType;
use App\Services\EleveService;
use App\Services\ShowClasse;
use Doctrine\Common\Persistence\ObjectManager;
use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    /**
     * @Route("/classe", name="classe")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($classe);
            $em->flush();
            $this->addFlash('success', 'Article Created!');
        }
        return $this->render('classe/index.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/listeClasse", name="liste_classe")
     */
    public function showClasse(ShowClasse $classe)
    {
        $res = $classe->showClasse();
        return $this->render('classe/listeClasse', ['classes' => $res]);
    }

    /**
     * @Route("/classe/delete/{id}", name="exempleee_delete")
     * Method ({"DELETE"})
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $classe = $em->getRepository(Classe::class)->find($id);
        $em->remove($classe);
        $em->flush();
        return $this->redirectToRoute('liste_classe');
    }

    /**
     * @Route ("/classe/update/{id}", name="update_classe")
     * Method ({"GET", "POST"})
     */
    public function editerClasse(Request $request, Classe $classe, $id)
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_classe');
        }

        return $this->render('classe/Editer', [
            'classes' => $classe,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/classe/details/{id}", name="classe_details")
     * @Method ({"GET"})
     */
    public function detailsClasse($id,EleveService $e)
    {
        $em = $this->getDoctrine();
        $repo = $em->getRepository(Classe::class);
        $classe = $repo->find($id);
        $eleve=$e->findfName($id);
        dump($e->findfName($id));
        return $this->render('classe/Details.html.twig', [
            'classes' => $classe,'eleves'=>$eleve
        ]);
    }

//    /**
//     * @Route("/classe/delete/{id}"), name="classe_delete"
//     * @Method ({"DELETE"})
//     */
//    public function SupprimeClasse($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $classe = $em->getRepository(Classe::class)->find($id);
//        $em->remove($classe);
//        $em->flush();
//        return $this->redirectToRoute('liste_classe');
//    }


//    /**
//     * @Route("/classe/new", name="classe2")
//     */
//
//    public function new(Request $request)
//    {
//        $classe = new Classe();
//
//        // dummy code - this is here just so that the Task has some tags
//        // otherwise, this isn't an interesting example
//        $eleve1 = new Eleve();
//        $eleve1->setNom('eleve1');
//        $classe->getEleves()->add($eleve1);
//
//
////        $eleve2 = new Eleve();
////        $eleve2->setNom('eleve2');
////        $classe->getEleves()->add($eleve2);
//        // end dummy code
//
//        $form = $this->createForm(ClasseType::class, $classe);
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            // ... maybe do some form processing, like saving the Task and Tag objects
//        }
//
//        return $this->render('classe/new', [
//            'form' => $form->createView(),
//        ]);
//    }





    /**
     * @Route("/classe/new", name="new_classe_eleve")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function Create(Request $request, ObjectManager $manager)
    {

        $em = $this->getDoctrine()->getManager();
        $classe = new Classe();

//        $eleve=new Eleve();
//        dd($eleve);
//        $classe->getEleves()->add($eleve);

        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid() && $request->isMethod('POST')) {
                foreach ($classe->getEleves() as $eleve) {
                    $eleve->setClasse($classe);
                }
                $em->persist($classe);
                $em->flush();
            } else {

                $errors = $form->getErrors();
                $str = '';
                foreach ($errors as $error) {
                    $str .= ' ' . $error->getMessage();
                }

                die('eer=>' . $str);
            }
        }
        return $this->render('classe/new', [
            'form' => $form->createview()
        ]);
    }




}