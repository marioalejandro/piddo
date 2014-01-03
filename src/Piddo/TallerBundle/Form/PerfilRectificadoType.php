<?php

namespace Piddo\TallerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PerfilRectificadoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupoRectificado',null, array(
                'disabled' => true,
            ))
            ->add('cantidad','integer', array(
                'invalid_message' => 'Ingrese solo números'
            ))
            ->add('rectificado',null, array(
                'disabled' => true
            ));

   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\TallerBundle\Entity\PerfilRectificado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'perf_rect';
    }
}
