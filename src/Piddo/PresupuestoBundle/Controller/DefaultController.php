<?php

namespace Piddo\PresupuestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\PresupuestoBundle\Entity\Presupuesto;
use Piddo\PresupuestoBundle\Form\PresupuestoType;
use Piddo\PresupuestoBundle\Form\PresupuestoRecepcionType;

class DefaultController extends Controller
{
    public function nuevoAction()
    {
        $peticion = $this->getRequest();

        $em = $this->getDoctrine()->getManager();

        /*****  CREACION FORMULARIO CLIENTE + MOTOR  *****/
        $presupuesto = new Presupuesto();

        $presupuesto->setFechaCreacion(new \DateTime('now'));
        $presupuesto->setFechaEntrega(new \DateTime('tomorrow'));
        $presupuesto->setEstado('PENDIENTE');

        $presupuesto->setDescuento(0);
        $presupuesto->setTotalGeneral(0);
        $presupuesto->setTotalRectificados(0);
        $presupuesto->setTotalRepuestos(0);
        $presupuesto->setMotivoDescuento('');

        $formulario = $this->createForm(new PresupuestoType(), $presupuesto);

        /*****  VALIDACION FORMULARIO   *****/
        $formulario->handleRequest($peticion);
        if($formulario->isSubmitted()){

        }

        if($formulario->isValid()){
            $em->persist($presupuesto);
            $em->flush();

            if($formulario->get('Recepcion')->isClicked())
                {
                $pre = $presupuesto->getId();
                return $this->redirect($this->generateUrl('presupuesto_recepcion',array('presupuesto' => $pre)));
                }
            
           $mensaje = 'El Presupuesto se ha guardado correctamente';
           $this->get('session')->getFlashBag()->add('info', $mensaje);

            return $this->redirect($this->generateUrl('nuevo_presupuesto'));

        }

        return $this->render('PresupuestoBundle:Default:presupuestoCliente.html.twig', 
                array(
                    'form' => $formulario->createView(),
                ));
    }
 
public function recepcionAction($presupuesto)
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $presupuesto = $em->getRepository('PresupuestoBundle:Presupuesto')->findOneBy(array('id'=> $presupuesto));
        //if($formulario->get('Recepcion')->isClicked()){

        $serie = $presupuesto->getSerie();
        $motorProfile = $serie->getPiezasDisponibles();
        $gruposPieza = $em->getRepository('MotorBundle:GrupoPieza')->findAll();
        //Formulario de Recepcion (Coleccion de ColPiezas)

        //1.- Creacion de objeto presupuesto (creado) $presupuesto
        //2.- Creacion de los objetos Recepcion
        //Datos desde BD
        $i=0;
        //Recorremos los grupos
        while($i < sizeof($gruposPieza))
        {
            $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $gruposPieza[$i]->getID()));
            $j=0;
            //Recorremos las piezas por grupo
            while($j<sizeof($piezas))
            {
                //Vemos si el motor ya tiene agregada esa pieza
                //para cargar el valor de maximo
                $k=0;
                $nuevo = true;
                while($k < sizeof($motorProfile))
                {
                    if($motorProfile[$k]->getPieza() == $piezas[$j])
                        {
                        $recepcion = new \Piddo\MotorBundle\Entity\Recepcion();
                        $recepcion->setCantidad(0);
                        $recepcion->setPresupuesto($presupuesto);
                        $recepcion->setColPieza($motorProfile[$k]);
                        $presupuesto->getRecepcionPiezas()->add($recepcion);
                        }
                    $k++;
                }
                $j++;
            }
            $i++;
        }

        //3.- Agregar los Recepcion a el presupuesto(hecho)
        //4.- Creacion de formulario
        $formRecepcion = $this->createForm(new PresupuestoRecepcionType(), $presupuesto);
     
        $formRecepcion->handleRequest($peticion);

        if($formRecepcion->isValid()){
        $em->persist($presupuesto);
        $em->flush();

        $mensaje ='El Presupuesto se ha modificado correctamente';

        $this->get('session')->getFlashBag()->add('info', $mensaje);

        }

            return $this->render('PresupuestoBundle:Default:presupuestoRecepcion.html.twig', 
         array(
             'form' => $formRecepcion->createView(),
         ));     
        }
}

