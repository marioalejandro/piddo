<?php

namespace Piddo\TallerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColRectificadoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad',null, array(
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
            'data_class' => 'Piddo\TallerBundle\Entity\ColRectificado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'piddo_tallerbundle_colrectificado';
    }
}
