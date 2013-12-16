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
        
        /*****  CREACION FORMULARIO   *****/
        $presupuesto = new Presupuesto();
        $formulario = $this->createForm(new PresupuestoType(), $presupuesto);

        /*****  VALIDACION FORMULARIO   *****/
        $formulario->handleRequest($peticion);
        
        if($formulario->isValid()){
            $em->persist($presupuesto);
            $em->flush();
            
            /*$mensaje = $formulario->get('mensaje')->isClicked()
                ? 'mensaje!!!!'
                : 'El cliente se ha agregado correctamente';*/
           $mensaje = 'El cliente se ha agregado correctamente';
           $this->get('session')->getFlashBag()->add('info', $mensaje);


            return $this->redirect($this->generateUrl('nuevo_presupuesto'));
        
        }
        
        
        return $this->render('PresupuestoBundle:Default:presupuestoCliente.html.twig', 
                array(
                    'form' => $formulario->createView(),
                ));
    }
}
