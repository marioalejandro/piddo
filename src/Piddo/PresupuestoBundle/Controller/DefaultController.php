<?php

namespace Piddo\PresupuestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\PresupuestoBundle\Entity\Presupuesto;
use Piddo\PresupuestoBundle\Form\PresupuestoType;

class DefaultController extends Controller
{
    public function nuevoAction()
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        /*****  CREACION FORMULARIO CLIENTE + MOTOR  *****/
        $presupuesto = new Presupuesto();
        $formulario = $this->createForm(new PresupuestoType(), $presupuesto);

        /*****  VALIDACION FORMULARIO   *****/
        $formulario->handleRequest($peticion);
        
        if($formulario->isSubmitted()){
            
            
            
        }
        
        if($formulario->isValid()){
            $presupuesto->setFechaCreacion(new \DateTime('now'));
            $presupuesto->setFechaEntrega(new \DateTime('tomorrow'));
            $presupuesto->setEstado('PENDIENTE');
            
            $presupuesto->setDescuento(0);
            $presupuesto->setTotalGeneral(0);
            $presupuesto->setTotalRectificados(0);
            $presupuesto->setTotalRepuestos(0);
            $presupuesto->setMotivoDescuento('NO HAY');
            
            $em->persist($presupuesto);
            $em->flush();
            
            if($formulario->get('Siguiente')->isClicked()){
                return $this->render('PresupuestoBundle:Default:presupuestoRecepcion.html.twig', 
                     array(
                         'form' => $formulario->createView(),
                     ));     
            }
            
            /*$mensaje = $formulario->get('mensaje')->isClicked()
                ? 'mensaje!!!!'
                : 'El cliente se ha agregado correctamente';/**/
           $mensaje = 'El cliente se ha agregado correctamente';
           $this->get('session')->getFlashBag()->add('info', $mensaje);


            return $this->redirect($this->generateUrl('nuevo_presupuesto'));
        
        }
        
        
        return $this->render('PresupuestoBundle:Default:presupuestoCliente.html.twig', 
                array(
                    'form' => $formulario->createView(),
                ));
    }

    public function modelosAction()
    {
        $marca_id = $this->getRequest()->request->get('marca_id');

        $em = $this->getDoctrine()->getManager();

        $modelos = $em->getRepository('MotorBundle:Modelo')->findByMarca($marca_id);

            
        return array( 'modelos' => $modelos);
    }

    public function seriesAction()
    {
        $modelo_id = $this->getRequest()->request->get('modelo_id');

        $em = $this->getDoctrine()->getManager();

        $series = $em->getRepository('MotorBundle:City')->findByModeloId($modelo_id);

        return $this->render('PresupuestoBundle:Default:presupuestoCliente.html.twig', array(
            'series' => $series
        ));
    }
}
