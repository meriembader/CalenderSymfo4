<?php

namespace App\Form;

use App\Entity\DispoAh;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DispoAhType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refto_med_id')
            ->add('titre')
            ->add('debut')
            ->add('fin')
            ->add('descp')
            ->add('all_day')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DispoAh::class,
        ]);
    }
}
