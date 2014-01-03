<?php

namespace Piddo\ComponenteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PerfilComponenteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('grupoComponente',null, array(
                'disabled' => true,
            ))
            ->add('componente',null, array(
                'disabled' => true
            ))
            ->add('maximo','integer', array(
                'invalid_message' => 'Ingrese solo números',
            ))
            

        ;
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\ComponenteBundle\Entity\PerfilComponente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'perf_comp';
    }
}
