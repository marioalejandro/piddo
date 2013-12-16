<?php
 
namespace Piddo\PresupuestoBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Piddo\MotorBundle\Entity\Serie;
use Piddo\MotorBundle\Entity\Modelo;
 
class AddSerieFieldSubscriber implements EventSubscriberInterface
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
 
    private function addSerieForm($form, $modelo)
    {
        $form->add($this->factory->createNamed('serie','entity', null, array(
            'class'         => 'MotorBundle:Serie',
            'empty_value'   => 'Serie',
            'auto_initialize' => false,
            'query_builder' => function (EntityRepository $repository) use ($modelo) {
                $qb = $repository->createQueryBuilder('serie')
                    ->innerJoin('serie.modelo', 'modelo');
                if ($modelo instanceof Modelo) {
                    $qb->where('serie.modelo = :modelo')
                    ->setParameter('modelo', $modelo);
                } elseif (is_numeric($modelo)) {
                    $qb->where('modelo.id = :modelo')
                    ->setParameter('modelo', $modelo);
                } else {
                    $qb->where('modelo.nombre = :modelo')
                    ->setParameter('modelo', null);
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
        $this->addSerieForm($form, $modelo);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $modelo = array_key_exists('modelo', $data) ? $data['modelo'] : null;
        $this->addSerieForm($form, $modelo);
    }
}