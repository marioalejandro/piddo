<?php
 
namespace Piddo\PresupuestoBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Piddo\MotorBundle\Entity\Marca;
 
class AddModeloFieldSubscriber implements EventSubscriberInterface
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
 
    private function addModeloForm($form, $modelo, $marca)
    {
        $form->add($this->factory->createNamed('modelo','entity', $modelo, array(
            'class'         => 'MotorBundle:Modelo',
            'empty_value'   => 'Modelo',
            'mapped'        => false,
            'auto_initialize' => false,
            'query_builder' => function (EntityRepository $repository) use ($marca) {
                $qb = $repository->createQueryBuilder('modelo')
                    ->innerJoin('modelo.marca', 'marca');
                if($marca instanceof Marca){
                    $qb->where('modelo.marca = :marca')
                    ->setParameter('marca', $marca);
                }elseif(is_numeric($marca)){
                    $qb->where('marca.id = :marca')
                    ->setParameter('marca', $marca);
                }else{
                    $qb->where('marca.nombre = :marca')
                    ->setParameter('marca', null);
                }
 
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
 
        $modelo = ($data->getSerie()) ? $data->getSerie()->getModelo() : null ;
        $marca = ($modelo) ? $modelo->getMarca() : null ;
        $this->addModeloForm($form, $modelo, $marca);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $modelo = array_key_exists('modelo', $data) ? $data['modelo'] : null;
        $marca = array_key_exists('marca', $data) ? $data['marca'] : null;
        $this->addModeloForm($form, $modelo, $marca);
    }
}