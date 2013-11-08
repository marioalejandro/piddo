<?php
namespace Piddo\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GrupoRectificadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('nombre');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\TallerBundle\Entity\GrupoRectificado'
        ));
    }
    public function getName() {
        return 'piddo_adminbundle_gruporectificadotype';
    }    
}

?>
