<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;

class OfertaType extends AbstractType
{
    /**
     * Define los campos del formulario de crear y modificar ofertas
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
            ->add('descripcion', TextareaType::class, array(
                'label' => 'Descripción',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('condiciones', TextareaType::class, array(
                'label' => 'Condiciones',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('fotoTemp', FileType::class, array(
                'label' => 'Imagen',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('precio', MoneyType::class, array(
                'label' => 'Precio',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('descuento', MoneyType::class, array(
                'label' => 'Descuento',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('umbral', TextType::class, array(
                'label' => 'Compras necesarias para activar oferta',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('fechaPublicacion', DateType::class, array(
                'label' => 'Fecha que desea publicar la oferta',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => ''
                )
            ))
            ->add('fechaExpiracion', DateType::class, array(
                'label' => 'Fecha de expiración de la oferta',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => ''
                )
            ));

        if ('crear_oferta' === $options['accion']) {
            $builder
                ->add('crear', SubmitType::class, array(
                    'label' => 'Crear Oferta',
                    "attr" => array(
                        "class" => "form-submit btn btn-success"
                    )
                ))
                ->add('condiciones', CheckboxType::class, array(
                    'label' => 'Acepto condiciones',
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'required' => 'required',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'mapped' => false,
                    'constraints' => new IsTrue(array(
                        'message' => 'Debes aceptar las condiciones indicadas antes de poder añadir una nueva oferta',
                    )),
                ));

        } elseif ('modificar_oferta' === $options['accion']) {
            $builder
                ->add('guardar', SubmitType::class, array(
                    'label' => 'Guardar Cambios',
                    "attr" => array(
                        "class" => "form-submit btn btn-success"
                    )
                ));

        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'accion' => 'modificar_oferta',
            'data_class' => 'AppBundle\Entity\Oferta',
            // indicar para la validacion de tipo adhoc el lugar de los mensajes de error
            'error_mapping' => array(
                'FechaValida' => 'fechaExpiracion'
            ),
        ));

    }

    public function getBlockPrefix()
    {
        return 'oferta';
    }
}