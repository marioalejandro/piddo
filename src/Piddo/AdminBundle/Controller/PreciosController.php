<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\MotorBundle\Entity\TipoMotor;
use Piddo\AdminBundle\Form\TipoMotorType;
use Piddo\AdminBundle\Entity\Precio;


class PreciosController extends Controller
{


    public function preciosAction()
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $tipos = $em->getRepository('MotorBundle:TipoMotor')->findAll();
        
        $tipoMotor = new TipoMotor();
        $formulario = $this->createForm(new TipoMotorType(), $tipoMotor);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $em->persist($tipoMotor);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('info', 'El tipo '.$tipoMotor->getNombre().' de motor ha sido creado');
            return $this->redirect($this->generateUrl('precios'));
        }
        return $this->render('AdminBundle:Default:precios.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'tipos' => $tipos
                ));
    }
    
    public function tiposAction($tipo)
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $tipo = $em->getRepository('MotorBundle:TipoMotor')->findOneById($tipo);
        $gRectificado = $em->getRepository('TallerBundle:GrupoRectificado')->findAll();
        $precios = $tipo->getPrecios();
        
        foreach ($gRectificado as $gr)
        {
            $rectificados = $gr->getRectificados();
            foreach ($rectificados as $rec)
            {
                $nuevo = true;
                //Se compara cada rectificado con los precios guardados
                foreach ($precios as $pre)
                {
                    if($rec == $pre->getRectificado())
                    {
                        $nuevo = false;
                    }
                }
                if($nuevo)
                {
                    $precio = new Precio();
                    $precio->setRectificado($rec);
                    $precio->setTipoMotor($tipo);
                    //3.- Agregar los perfiles a la serie
                    $tipo->getPrecios()->add($precio);
                }
            }
        }
        
        //4.- Creacion de formulario
        $formulario = $this->createForm(
                new \Piddo\AdminBundle\Form\TipoMotorPreciosType(), 
                $tipo, 
                array(
                    'data' => $tipo
                )
            
        );
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $em->persist($tipo);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('info', 'El tipo '.$tipo->getNombre().' de motor ha modificado');
            return $this->redirect($this->generateUrl('tipo',array('tipo' => $tipo->getId())));
        }
        return $this->render('AdminBundle:Default:tipos.html.twig', 
                array(
                    'form' => $formulario->createView(),
                    'tipo' => $tipo
                ));
      }
}
