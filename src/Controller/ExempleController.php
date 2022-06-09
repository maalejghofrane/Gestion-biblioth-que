<?php

namespace App\Controller;

use App\Entity\Exemple;
use App\Form\ExempleType;
use App\Repository\ExempleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exemple")
 */
class ExempleController extends AbstractController
{
    /**
     * @Route("/", name="exemple_index", methods={"GET"})
     */
    public function index(ExempleRepository $exempleRepository): Response
    {
        return $this->render('exemple/index.html.twig', [
            'exemples' => $exempleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="exemple_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $exemple = new Exemple();
        $form = $this->createForm(ExempleType::class, $exemple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exemple);
            $entityManager->flush();

            return $this->redirectToRoute('exemple_index');
        }

        return $this->render('exemple/new.html.twig', [
            'exemple' => $exemple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exemple_show", methods={"GET"})
     */
    public function show(Exemple $exemple): Response
    {
        return $this->render('exemple/show.html.twig', [
            'exemple' => $exemple,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exemple_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exemple $exemple): Response
    {
        $form = $this->createForm(ExempleType::class, $exemple);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exemple_index', [
                'id' => $exemple->getId(),
            ]);
        }

        return $this->render('exemple/edit.html.twig', [
            'exemple' => $exemple,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exemple_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Exemple $exemple): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exemple->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exemple);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exemple_index');
    }
}
