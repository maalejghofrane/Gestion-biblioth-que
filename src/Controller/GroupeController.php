<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Form\GroupeType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Tests\Compiler\G;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe", name="groupe")
     */
    public function index(Request $request)

    { $em=$this->getDoctrine()->getManager();
        $groupe= new Groupe();
    $form =$this->createForm(GroupeType::class,$groupe);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($groupe);
            $em->flush();

        }

        return $this->render('groupe/index.html.twig' ,['form'=>$form->createView()] ) ;
    }

}
