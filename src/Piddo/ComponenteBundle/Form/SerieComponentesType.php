<?php
namespace Piddo\ComponenteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Piddo\ComponenteBundle\Form\PerfilComponenteType;

class SerieComponentesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $serie = $options['data'];
        //print_r($serie->getNombre());
        
        $builder->add('nombre');
        
        $builder->add('perfilComponentes', 'collection', array(
            'type' => new PerfilComponenteType()
            ));
        
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\MotorBundle\Entity\Serie'
        ));
    }
    public function getName() {
        return 'serie_perf_comp';
    }    
}

?>
