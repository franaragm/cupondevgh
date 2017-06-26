<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Ciudad;

class TiendaType extends AbstractType
{
    /**
     * Formulario para crear y manipular entidades de tipo Tienda.
     * Como se utiliza en la extranet, algunas propiedades de la entidad
     * no se incluyen en el formulario.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('login', TextType::class, array(
                'label' => 'Nombre de usuario',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control',
                    'readonly' => true
                )
            ))
            ->add('passwordEnClaro', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'required' => false,
                'first_options' => array(
                    'label' => 'Contraseña',
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ),
                'second_options' => array(
                    'label' => 'Repite Contraseña',
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ),
            ))
            ->add('descripcion', TextareaType::class, array(
                'label' => 'Descripción de la tienda',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('ciudad', EntityType::class, array(
                'label' => 'Ciudad',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'class' => Ciudad::class,
                'placeholder' => 'Selecciona una ciudad',
                'required' => 'required',
                'query_builder' => function (EntityRepository $repositorio) {
                    return $repositorio->createQueryBuilder('c')
                        ->orderBy('c.nombre', 'ASC');
                },
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('guardar', SubmitType::class, array(
                'label' => 'Guardar Cambios',
                "attr" => array(
                    "class" => "form-submit btn btn-success"
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tienda',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tienda';
    }
}
