<?php

namespace AppBundle\Form;

use AppBundle\Entity\Ciudad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class UsuarioType extends AbstractType
{
    /**
     * Define los campos del formulario de registro
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
            ->add('apellidos', TextType::class, array(
                'label' => 'Apellido',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Correo electrónico',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('passwordEnClaro', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'first_options' => array(
                    'label' => 'Contraseña',
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'required' => 'required',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ),
                'second_options' => array(
                    'label' => 'Repite Contraseña',
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'required' => 'required',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ),
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-location form-control'
                )
            ))
            ->add('permiteEmail', CheckboxType::class, array(
                'label' => 'Suscribirse a boletín de noticias',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => false
            ))
            ->add('fechaNacimiento', BirthdayType::class, array(
                'label' => 'Fecha de Nacimiento',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'years' => range(date('Y') - 18, date('Y') - 18 - 120),
                'attr' => array(
                    'class' => ''
                )
            ))
            ->add('dni', TextType::class, array(
                'label' => 'DNI',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => 'required',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('numeroTarjeta', TextType::class, array(
                'label' => 'Número de tarjeta de crédito',
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
            ->add('registrarme', SubmitType::class, array(
                'label' => 'Registrarme',
                "attr" => array(
                    "class" => "form-submit btn btn-success"
                )
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
            'error_mapping' => array(
                'mayorDeEdad' => 'fechaNacimiento'
            ),
        ));

    }

    public function getBlockPrefix()
    {
        return 'usuario';
    }
}