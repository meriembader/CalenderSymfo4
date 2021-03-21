<?php

namespace App\Form;

use App\Entity\Doctor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('Nom')
            ->add('Prenom')
            ->add('Age')
            ->add('Email')
            ->add('phoneNumber')
            ->add('adresse')
            ->add('Password')
            ->add('status')
            ->add('specialite')
            ->add('price')
            ->add('Description')
            ->add('recivedNotif')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doctor::class,
        ]);
    }
}
