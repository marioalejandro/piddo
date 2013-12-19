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
        /******************************************************
        *                PARTE 1
        ****************************************************/
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
            /******************************************************
             *                PARTE 2
             ****************************************************/
            if($formulario->get('Siguiente')->isClicked()){

                $serie = $presupuesto->getSerie();
                $motorProfile = $serie->getPiezasDisponibles();
                $gruposPieza = $em->getRepository('MotorBundle:GrupoPieza')->findAll();
                //Formulario de Recepcion (Coleccion de ColPiezas)
                /**************************************************************
         * NUEVO FORMULARIO CON OBJETOS
         **************************************************************/
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
                        print_r($recepcion->getColPieza()->getPieza()->getNombre());
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


            //return $this->redirect($this->generateUrl('admin_clientes'));
        
        }/**/
        /**************************************************************
         * FIN NUEVO FORMULARIO CON OBJETOS
         **************************************************************/
          /*      $defaultData = array();
                $builder = $this->createFormBuilder($defaultData);

                $i=0;
                while($i < sizeof($piezasSerie))
                    {
                        $pieza = $piezasSerie[$i]->getPieza();
                        //$pieza = $em->getRepository('MotorBundle:Pieza')->findOneBy(array('id' => $piezasSerie[$i]->getPieza()));
                        $builder->add($pieza->getSlug(),'number',array(
                            'label' => $pieza->getNombre(),
                            'data' => 0,
                        ));
                    $i++;
                    }
                 $form= $builder->getForm();

                 $form->handleRequest($peticion);

                    if ($form->isValid()) {
                        // data es un array con claves 'name', 'email', y 'message'
                        $data = $form->getData();
                        $i = 0;
                        while($i < sizeof($gruposPieza))
                            {
                            $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $gruposPieza[$i]->getID()));
                            $j=0;
                             while($j<sizeof($piezas))
                                 {
                                 //print_r($data[$piezas[$j]->getNombre()]);
                                 if($data[$piezas[$j]->getNombre()]>0){
                                     $colPieza = new ColPiezas();
                                     $colPieza->setMaximo($data[$piezas[$j]->getNombre()]);
                                     $colPieza->setPieza($piezas[$j]);
                                     $colPieza->setSerie($oSerie);
                                     $em->persist($colPieza);

                                 }

                                 $j++;
                                 }
                            $i++;
                            }
                            $em->flush();
                        //print_r($data);
                    }/**/
                return $this->render('PresupuestoBundle:Default:presupuestoRecepcion.html.twig', 
                     array(
                         'form' => $formRecepcion->createView(),
                     ));     
            }
            
            /*$mensaje = $formulario->get('mensaje')->isClicked()
                ? 'mensaje!!!!'
                : 'El cliente se ha agregado correctamente';/**/
           $mensaje = 'El Presupuesto se ha guardado correctamente';
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
