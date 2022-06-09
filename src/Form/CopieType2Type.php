<?php

namespace App\Form;

use App\Entity\Copie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CopieType2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref')
            ->add('datePret')
            ->add('DateRetour')
            ->add('etat')
            ->add('pretPar')
            ->add('ouvrage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Copie::class,
        ]);
    }
}
