<?php
namespace Piddo\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\TallerBundle\Form\ColRectificadoType;

class SerieRectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('nombre');
        $builder->add('rectDisponibles', 'collection', array('type' => new ColRectificadoType()));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\MotorBundle\Entity\Serie'
        ));
    }
    public function getName() {
        return 'piddo_adminbundle_serieRecttype';
    }    
}

?>
