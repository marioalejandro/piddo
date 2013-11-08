<?php
namespace Piddo\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RectificadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('nombre')
                ->add('grupoRectificado');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piddo\TallerBundle\Entity\Rectificado'
        ));
    }
    public function getName() {
        return 'piddo_adminbundle_rectificadotype';
    }    
}

?>
