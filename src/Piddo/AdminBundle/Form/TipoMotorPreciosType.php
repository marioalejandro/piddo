<?php
namespace Piddo\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\AdminBundle\Form\PrecioType;

class TipoMotorPreciosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('nombre');
        $builder->add('precios','collection',array(
            'type' => new PrecioType()
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\MotorBundle\Entity\TipoMotor'
        ));
    }
    public function getName() {
        return 'tipo_motor_prec';
    }    
}

?>
