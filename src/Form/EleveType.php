<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\Groupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('sexe')
//            ->add('classe')
//            ->add('classe', EntityType::class, array(
//                'class' => Classe::class,
//            ))
        ;
    }
//    public function buildForm2(FormBuilderInterface $builder, array $options)
//    {
//        $builder
//            ->add('nom')
//            ->add('sexe')
////            ->add('classe')
////            ->add('classe', EntityType::class, array(
////                'class' => Classe::class,
////            ))
//        ;
//    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
