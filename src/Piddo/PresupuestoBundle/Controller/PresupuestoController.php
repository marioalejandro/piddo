<?php

namespace Piddo\PresupuestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\PresupuestoBundle\Entity\Recepcion;
use Piddo\PresupuestoBundle\Entity\Presupuesto;
use Piddo\PresupuestoBundle\Form\PresupuestoType;
use Piddo\PresupuestoBundle\Form\PresupuestoRecepcionType;
use Piddo\PresupuestoBundle\Entity\Trabajo;
use Piddo\PresupuestoBundle\Form\PresupuestoTrabajosType;

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


            
           $mensaje = 'El Presupuesto se ha guardado correctamente';
           $this->get('session')->getFlashBag()->add('info', $mensaje);
           
           if($formulario->get('Recepcion')->isClicked())
                {
                $pre = $presupuesto->getId();
                return $this->redirect($this->generateUrl('presupuesto_recepcion',array('presupuesto' => $pre)));
                }

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
                        //Hasta aqui solo crea objetos recepcion
                        //De acuerdo al Perfil de la serie
                        //Ordenados según los grupos
                        //PERO NO FUNCIONA YA QUE IGUAL HAGO EL FORM CON EL PRESUPUESTO :D
                        //Ahora hay que ver si el presupuesto ya tenia componentes recepcionados
                        $nuevo = true;
                        foreach ($recepComponentes as $rc)
                        {
                            $componenteRecepcionado = $rc->getPerfilComponente()->getComponente();
                            if($c == $componenteRecepcionado)
                            {
                                $nuevo = false;
                                //$recepcion->setCantidad($componenteRecepcionado->getCantidad());
                            }
                        }
                        if($nuevo)
                        {
                            $recepcion = new Recepcion();
                            $recepcion->setPresupuesto($presupuesto);
                            $recepcion->setPerfilComponente($pc);
                            $presupuesto->getRecepcionComponentes()->add($recepcion);
                        }
                        
                        
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
        
        if($formRecepcion->get('Trabajos')->isClicked())
                {
                $pre = $presupuesto->getId();
                return $this->redirect($this->generateUrl('presupuesto_trabajos',array('presupuesto' => $pre)));
                }

        $this->get('session')->getFlashBag()->add('info', $mensaje);

        }

            return $this->render('PresupuestoBundle:Default:presupuestoRecepcion.html.twig', 
         array(
             'form' => $formRecepcion->createView(),
         ));     
    }
        
    public function trabajosAction($presupuesto)
    {
        $peticion = $this->getRequest();
       
        //obtencion de datos del modelo
        $em = $this->getDoctrine()->getManager();
        $presupuesto = $em->getRepository('PresupuestoBundle:Presupuesto')->findOneBy(array('id'=> $presupuesto));
        $serie = $presupuesto->getSerie();
        $perfilRectificados = $serie->getPerfilRectificados();
        $gruposRectificado = $em->getRepository('TallerBundle:GrupoRectificado')->findAll();
        $trabajos = $presupuesto->getTrabajos();

        //1.- Obtencion de objeto presupuesto (listo) $presupuesto
        //2.- Creacion de los objetos Trabajo

        foreach ($gruposRectificado as $gr)
        {
            
            //Recorremos los grupos
            $rectificados = $gr->getRectificados();
            foreach ($rectificados as $r)
            {
                
                //Recorremos los rectificados
                foreach ($perfilRectificados as $pr)
                {
                    if($r == $pr->getRectificado())
                    {
                        $nuevo = true;
                        foreach ($trabajos as $tr)
                        {
                            $trabajoIngresado = $tr->getRectificado();
                            if($r == $trabajoIngresado)
                            {
                                $nuevo = false;
                            }
                        }
                        if($nuevo)
                        {
                            $nuevoTrabajo = new Trabajo();
                            $nuevoTrabajo->setPresupuesto($presupuesto);
                            $nuevoTrabajo->setRectificado($r);
                            $presupuesto->getTrabajos()->add($nuevoTrabajo);
                        }
                        
                        
                    }
                }
            }
        }


        //3.- Agregar los Recepcion a el presupuesto(hecho)
        //4.- Creacion de formulario
        $formTrabajos = $this->createForm(new PresupuestoTrabajosType(), $presupuesto);
     
        $formTrabajos->handleRequest($peticion);

        if($formTrabajos->isValid()){
        $em->persist($presupuesto);
        $em->flush();

        $mensaje ='El Presupuesto se ha modificado correctamente';

        $this->get('session')->getFlashBag()->add('info', $mensaje);

        }

            return $this->render('PresupuestoBundle:Default:presupuestoTrabajos.html.twig', 
         array(
             'form' => $formTrabajos->createView(),
         ));     
    }
}

