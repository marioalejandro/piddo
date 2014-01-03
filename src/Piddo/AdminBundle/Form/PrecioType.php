<?php
namespace Piddo\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrecioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
           $builder
            ->add('grupoRectificado',null, array(
                'disabled' => true,
            ))
            ->add('rectificado',null, array(
                'disabled' => true
            ))
            ->add('precio','integer', array(
                'invalid_message' => 'Ingrese solo números'
            ))
            ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\AdminBundle\Entity\Precio'
        ));
    }
    public function getName() {
        return 'precio';
    }    
}

?>
