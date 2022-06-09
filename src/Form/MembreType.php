<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Membre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('sexe', ChoiceType::class, array(

                'choices' => array(
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ),
                'required' => true,
                'multiple' => false,))
            //->add('description',TextareaType::class,['attr'=>['placeholder'=>"Contenue de l'article",'class'=>'form-control']] )
            ->add('description')

                ->add('groupes', EntityType::class, array(
                    'class' => Groupe::class,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
