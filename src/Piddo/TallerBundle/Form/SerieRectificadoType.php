<?php
namespace Piddo\TallerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\TallerBundle\Form\PerfilRectificadoType;

class SerieRectificadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('nombre');
        $builder->add('perfilRectificados', 'collection', array('type' => new PerfilRectificadoType()));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\MotorBundle\Entity\Serie'
        ));
    }
    public function getName() {
        return 'serie_rect';
    }    
}

?>
