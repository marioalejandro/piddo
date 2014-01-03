<?php

namespace Piddo\PresupuestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\PresupuestoBundle\Form\RecepcionType;

class PresupuestoRecepcionType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recepcionComponentes','collection',array(
            'type' => new RecepcionType(),
        ));
        //Botones
        $builder->add('Guardar', 'submit');
        $builder->add('Trabajos', 'submit');
        
        
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
        return 'piddo_presupuestobundle_presupuestoR';
    }
}
