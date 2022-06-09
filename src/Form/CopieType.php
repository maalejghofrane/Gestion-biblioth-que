<?php

namespace App\Form;

use App\Entity\Copie;
use App\Entity\Ouvrage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CopieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref')
            ->add('datePret')
            ->add('DateRetour')
            ->add('etat')
            ->add('pretPar')
            ->add('ouvrages', EntityType::class, array(
                'class' => Ouvrage::class
                ,))
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Copie::class,
        ]);
    }
}
