<?php

namespace Piddo\PresupuestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PresupuestoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Cliente
        $builder->add('cliente');
        $builder->add('RMT');
        //Motor
        
        $builder->add('marca');
        $builder->add('modelo');
        $builder->add('serie'); /**/
        
        $builder->add('numMotor');
        //Botones
        $builder->add('Guardar', 'submit');
        $builder->add('Recepcion', 'submit');
        
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\PresupuestoBundle\Entity\Presupuesto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'presupuesto';
    }
}
