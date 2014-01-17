<?php

namespace Piddo\PresupuestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\PresupuestoBundle\Form\RepuestoType;

class PresupuestoRepuestosType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('repuestos','collection',array(
            'type' => new RepuestoType(),
        ));
        //Botones
        $builder->add('Guardar', 'submit');
        
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\RepuestoBundle\Entity\Repuestos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pres_repu';
    }
}
