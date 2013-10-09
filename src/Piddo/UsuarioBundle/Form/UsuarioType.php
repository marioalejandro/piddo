<?php
namespace Piddo\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder
                ->add('rut')
                ->add('nombre')
                ->add('apellidos')
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Las contraseñas no son iguales',
                    'options' => array('label' => 'contraseña')
                ))
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\UsuarioBundle\Entity\Usuario'
        ));
    }


    public function getName() {
        return 'piddo_usuariobundle_usuariotype';
    }    
}

?>
