<?php

namespace Piddo\MotorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecepcionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('grupoPieza',null, array(
                'data_class' => '\Piddo\MotorBundle\Entity\GrupoPieza',
                'disabled' => true,
                'label' => 'grupo pieza'
            ))
            ->add('maximo','integer', array(
                'disabled' => true,
                'label' => 'cantidad máxima'
            ))
            ->add('cantidad','integer',array(
                'data' => 0,
            ))
            ->add('colPieza',null,array(
                'disabled' =>true,
                'label' => 'pieza'
            ));
    print_r($builder->getData());
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\MotorBundle\Entity\Recepcion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'piddo_motorbundle_recepcion';
    }
}
