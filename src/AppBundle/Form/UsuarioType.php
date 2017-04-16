<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('email')
            ->add('password')
            ->add('direccion')
            ->add('permiteEmail')
            ->add('fechaNacimiento')
            ->add('dni')
            ->add('numero_tarjeta')
            ->add('ciudad')
            ->add('registrarme', 'submit');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
        ));

    }

    public function getBlockPrefix()
    {
        return 'usuario';
    }
}