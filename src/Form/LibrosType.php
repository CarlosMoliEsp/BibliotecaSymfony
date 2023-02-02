<?php

namespace App\Form;

use App\Entity\Libros;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LibrosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('editorial')
            ->add('autor')
            ->add('titulo')
            ->add('n_edicion')
            ->add('fecha_edicion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libros::class,
        ]);
    }
}
