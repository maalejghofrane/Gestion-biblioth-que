<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Services\ShowArticle;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController', 'articles' => $articles,
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('article/home.html.twig', ['title' => "bienvenue", 'age' => 3]);
    }
    /**
     * @Route("/article/create",name="article_create");
     */

    public function create(Request $request , ObjectManager $manager ) {
        $article=new Article();
        $form=$this->createFormBuilder($article)
        ->add('title',TextType::class,['attr'=>['placeholder'=>"Titre de l'article",'class'=>'form-control']])
        ->add('content',TextareaType::class,['attr'=>['placeholder'=>"Contenue de l'article",'class'=>'form-control']] )
        ->add('image',TextType::class,['attr'=>['placeholder'=>"Titre de l'image",'class'=>'form-control']])
        ->add('save',SubmitType::class, ['label'=>'Enregistrer'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $article->setCreatedAt(new \DateTime());
            $manager->persist(($article));
            $manager->flush();

            $this->addFlash('success', 'Article Created!');
            return $this->redirectToRoute('show_article',['id'=> $article->getId()]);

        }

        return $this->render('article/create.html.twig',['formArticle'=>$form->createView()]);
    }

    /**
     * @Route("/article/{id}", name="show_article")
     */

    public function show(Article $article)
    {
        return $this->render('article/show.html.twig', ['article' => $article]);
    }


    /**
* @Route("/art", name="show_articlee")
*/

    public function  ShowArticlee( ShowArticle $service){
        $res=$service->ShowArticle() ;
        return  $this->render('article/show1.html.twig',['articles'=>$res]);
    }

}

