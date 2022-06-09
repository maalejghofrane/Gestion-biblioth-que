<?php

namespace App\Controller;

use App\Services\AleatoireService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\component\Form\FormTypeInterface;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne")
     */
    public function index()
    {
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
        ]);
    }


//    public function proc(FormBuilderInterface $builder ,Request $request, ObjectManager $manager) {
//
//        $builder
//            ->add('nom')
//            ->add('niveau');
//        $form = $this->createForm();
//        $form->handleRequest($request);
//        return $this->render('personne/index.html.twig/new', [
//            'form' => $form->createview()
//        ]);
//    }
    /**
     * @Route("/proc", name="proc")
     */
    public function proc( Request $request)
    {
        $defaultData = ['message' => 'Type your message here'];

        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class)

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//             data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $process = new Process('php C:\xampp\htdocs\symfony\my-project\bin\console app:create-pers '.$data['name']);
            $process->setTimeout(100);
            $process->start();
            $process->wait();
        }
        return $this->render('personne/index.html.twig', [
            'form' => $form->createview()
        ]);

}
}
