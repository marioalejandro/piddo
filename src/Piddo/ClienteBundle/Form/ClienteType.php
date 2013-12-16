<?php

namespace Piddo\ClienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\ClienteBundle\Form\TelefonoType;

class ClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rut')
            ->add('nombre')
            ->add('apellidos',NULL, array(
                'required' => false,
            ))
            ->add('telefonos', 'collection', array(
                'type' => new TelefonoType(),
                'allow_add'    => true,
                'by_reference' => false,
                'allow_delete' => true
            ))    
            
            ->add('Guardar', 'submit')
            ->add('mensaje', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\ClienteBundle\Entity\Cliente',
            'cascade_validation' => true
        ));
    }
 

    /**
     * @return string
     */
    public function getName()
    {
        return 'piddo_clientebundle_cliente';
    }
}
