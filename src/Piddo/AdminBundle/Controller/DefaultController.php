<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\MotorBundle\Entity\Marca;
use Piddo\MotorBundle\Entity\Modelo;
use Piddo\AdminBundle\Form\MarcaType;
use Piddo\AdminBundle\Form\ModeloType;

class DefaultController extends Controller
{
    public function portadaGerenciaAction()
    {
        return $this->render('AdminBundle:Default:portadaGerencia.html.twig');
    }
    public function marcasAction()
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $marca = new Marca();
        $formulario = $this->createForm(new MarcaType(), $marca);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $em->persist($marca);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'La marca '.$marca->getNombre().' ha sido registrada correctamente');
            return $this->redirect($this->generateUrl('admin_marcas'));
        }
        return $this->render('AdminBundle:Default:marcas.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'marcas' => $em->getRepository('MotorBundle:Marca')->findMarcas()
                ));
      }
      public function borrarMarcaAction($marca)
      {
          $em = $this->getDoctrine()->getManager();
          $em->getRepository('MotorBundle:Marca')->deleteMarca($marca);
            $this->get('session')->getFlashBag()->add('info', 'La marca ha sido borrada');
          return $this->redirect($this->generateUrl('admin_marcas'));
      }
       public function modelosAction($marca)
       {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $modelo = new Modelo();
        $formulario = $this->createForm(new ModeloType(), $modelo);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            //$modelo->setMarca($em->getRepository('MotorBundle:Marca')->findBy(array('slug'=>$marca)));
            
            $em->persist($modelo);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'El Modelo '.$modelo->getNombre().' ha sido registrado correctamente');

            return $this->redirect($this->generateUrl('admin_modelos',array('marca'=> $marca)));
        }
        return $this->render('AdminBundle:Default:modelos.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'modelos' => $em->getRepository('MotorBundle:Modelo')->findAll()
                    //'marca' => $em->getRepository('MotorBundle:Marca')->findMarcaModelos($marca)
                ));
      }
}
