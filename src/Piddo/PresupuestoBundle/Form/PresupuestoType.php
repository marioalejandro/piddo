<?php

namespace Piddo\PresupuestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\PresupuestoBundle\Form\EventListener\AddMarcaFieldSubscriber;
use Piddo\PresupuestoBundle\Form\EventListener\AddModeloFieldSubscriber;
use Piddo\PresupuestoBundle\Form\EventListener\AddSerieFieldSubscriber;
use Piddo\PresupuestoBundle\Form\PresupuestoRecepcionType;

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
        /*
        $factory = $builder->getFormFactory();
        $serieSubscriber = new AddSerieFieldSubscriber($factory);
        $builder->addEventSubscriber($serieSubscriber);
        $modeloSubscriber = new AddModeloFieldSubscriber($factory);
        $builder->addEventSubscriber($modeloSubscriber);
        $marcaSubscriber = new AddMarcaFieldSubscriber($factory);
        $builder->addEventSubscriber($marcaSubscriber); /**/
        
        $builder->add('marca');
        $builder->add('modelo');
        $builder->add('serie'); /**/
        
        $builder->add('numMotor');
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
        return 'piddo_presupuestobundle_presupuesto';
    }
}
