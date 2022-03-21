<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, array(
                'label' => 'Je suis :',
                'mapped' => true,
                'expanded' => true,
                'multiple' => true,
                'choices' => array(
                    'administrateur' => 'ROLE_ADMIN',
                    'hébergeur' => 'ROLE_HEBERGEUR',
                    'joueur' => 'joueur',
                    'arbitre' => 'arbitre',
                    'user' => 'ROLE_USER',
                )
            ))
            ->add('password');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
