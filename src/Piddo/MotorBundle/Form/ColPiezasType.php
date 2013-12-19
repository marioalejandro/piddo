<?php

namespace Piddo\MotorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColPiezasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maximo',null, array(
                'invalid_message' => 'Ingrese solo números'
            ))
            
            ->add('pieza',null, array(
                'disabled' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\MotorBundle\Entity\ColPiezas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'piddo_motorbundle_colpiezas';
    }
}
