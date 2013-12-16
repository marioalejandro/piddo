<?php
 
namespace Piddo\PresupuestoBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Piddo\MotorBundle\Entity\Marca;
 
class AddMarcaFieldSubscriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }
 
    private function addMarcaForm($form, $marca)
    {
        $form->add($this->factory->createNamed('marca', 'entity', $marca, array(
            'class'         => 'MotorBundle:Marca',
            'mapped'        => false,
            'empty_value'   => 'Marca',
            'auto_initialize' => false,
            'query_builder' => function (EntityRepository $repository) {
                $qb = $repository->createQueryBuilder('marca');
 
                return $qb;
            }
        )));
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $marca = ($data->getSerie()) ? $data->getSerie()->getModelo()->getMarca() : null ;
        $this->addMarcaForm($form, $marca);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $marca = array_key_exists('marca', $data) ? $data['marca'] : null;
        $this->addMarcaForm($form, $marca);
    }
}