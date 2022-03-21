<?php

namespace App\Form;

use App\Entity\Hebergeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class HebergeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userName')
            ->add('role')
            ->add('nomHotel')
            ->add('localisation')
            ->add('NombreEtoiles')
            ->add('services', ChoiceType::class, array(
                'label' => 'Veuillez selectionner les services offerts par votre établissement',
                'mapped' => true,
                'expanded' => true,
                'multiple' => true,
                'choices' => array(
                    'bar' => 'bar',
                    'petit-dejeuner'=> 'petit-dejeuner',
                    'restaurant' => 'restaurant',
                    'sauna' => 'sauna',
                    'salle de sport' => 'salle de sport',
                    'coiffeur' => 'coiffeur',
                    'pressing' => 'pressing',
                    'hammam' => 'hammam'
                )
            ))
            ->add('nbchambres')
            ->add('nblits');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hebergeur::class,
        ]);
    }
}
