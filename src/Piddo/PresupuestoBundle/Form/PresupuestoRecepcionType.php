<?php

namespace Piddo\PresupuestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\PresupuestoBundle\Form\EventListener\AddMarcaFieldSubscriber;
use Piddo\PresupuestoBundle\Form\EventListener\AddModeloFieldSubscriber;
use Piddo\PresupuestoBundle\Form\EventListener\AddSerieFieldSubscriber;
use Piddo\MotorBundle\Form\RecepcionType;

class PresupuestoRecepcionType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recepcionPiezas','collection',array(
            'type' => new RecepcionType(),
        ));
        //Botones
        
        $builder->add('Guardar', 'submit');
        $builder->add('Siguiente', 'submit');
        
        
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
