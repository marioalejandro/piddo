<?php

namespace Piddo\PresupuestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\PresupuestoBundle\Entity\Recepcion;
use Piddo\PresupuestoBundle\Entity\Presupuesto;
use Piddo\PresupuestoBundle\Form\PresupuestoType;
use Piddo\PresupuestoBundle\Form\PresupuestoRecepcionType;

class PresupuestoController extends Controller
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
       
        //obtencion de datos del modelo
        $em = $this->getDoctrine()->getManager();
        $presupuesto = $em->getRepository('PresupuestoBundle:Presupuesto')->findOneBy(array('id'=> $presupuesto));
        $serie = $presupuesto->getSerie();
        $perfilComponentes = $serie->getPerfilComponentes();
        $gruposComponentes = $em->getRepository('ComponenteBundle:GrupoComponente')->findAll();
        $recepComponentes = $presupuesto->getRecepcionComponentes();

        //1.- Obtencion de objeto presupuesto (listo) $presupuesto
        //2.- Creacion de los objetos Recepcion

        foreach ($gruposComponentes as $gc)
        {
            
            //Recorremos los grupos
            $componentes = $gc->getComponentes();
            foreach ($componentes as $c)
            {
                
                //Recorremos los componentes
                foreach ($perfilComponentes as $pc)
                {
                    if($c == $pc->getComponente())
                    {
                        $recepcion = new Recepcion();
                        $recepcion->setPresupuesto($presupuesto);
                        $recepcion->setPerfilComponente($pc);
                        //Hasta aqui solo crea objetos recepcion
                        //De acuerdo al Perfil de la serie
                        //Ordenados según los grupos
                        //Ahora hay que ver si el presupuesto ya tenia componentes recepcionados
                        foreach ($recepComponentes as $rc)
                        {
                            $componenteRecepcionado = $rc->getPerfilComponente()->getComponente();
                            if($c == $componenteRecepcionado)
                            {
                                $recepcion->setCantidad($componenteRecepcionado->getCantidad());
                            }
                        }
                        $presupuesto->getRecepcionComponentes()->add($recepcion);
                        
                    }
                }
            }
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

