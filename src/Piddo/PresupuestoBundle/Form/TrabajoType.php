<?php

namespace Piddo\PresupuestoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrabajoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('grupoRectificado','text', array(
                'disabled' => true,
            ))
            ->add('rectificado',null, array(
                'disabled' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\PresupuestoBundle\Entity\Trabajo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trabajo';
    }
}
