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
            ->add('maximo','integer')
            ->add('cantidad','integer',array(
                'data' => 0
            ))
            ->add('colPieza',null,array());
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