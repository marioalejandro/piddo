<?php

namespace Piddo\RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\MotorBundle\Entity\Marca;
use Piddo\MotorBundle\Entity\Modelo;
use Piddo\MotorBundle\Entity\Serie;
use Piddo\AdminBundle\Form\MarcaType;
use Piddo\AdminBundle\Form\ModeloType;
use Piddo\AdminBundle\Form\SerieType;
use Piddo\AdminBundle\Form\GrupoPiezaType;
use Piddo\AdminBundle\Form\SeriePiezasType;

class DefaultController extends Controller
{

 //Home page del recepcionista
    public function portadaRecepcionAction()
    {
        return $this->render('RecepcionBundle:Default:portadaRecepcion.html.twig');
    }
    
 //Creación de un presupuesto por parte del recepcionista
    public function crearPresupuestoAction()
    {
        return $this->render('RecepcionBundle:Default:crearPresupuesto.html.twig');
    }
    
 //Creación de un Motor por parte del recepcionista
    public function crearMotorAction()
    {
 /*Comunicación con la base de datos*/
        $peticion = $this->getRequest();        
        $em = $this->getDoctrine()->getManager();
        
        $marca = new Marca();
        
 /*Se crea el formulario*/
        $formulario = $this->createForm(new MarcaType(), $marca);
        
/*recibe y maneja el formulario*/
        $formulario->handleRequest($peticion);

/*En caso de que el formulario sea válido*/
        if($formulario->isValid()){
            $em->persist($marca);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'La marca '.$marca->getNombre().' ha sido registrada correctamente');
            return $this->redirect($this->generateUrl('recepcion_crear_motor'));
        }
        
        return $this->render('RecepcionBundle:Default:crearMotor.html.twig', 
               array(
                   'formulario' => $formulario->createView(),
                   'marcas' => $em->getRepository('MotorBundle:Marca')->findMarcas()
               ));
    }
    
//Creación de la modelo del motor
    public function crearMotorModeloAction($marca)
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('slug' => $marca));
        
        $modelo = new Modelo();
        $formulario = $this->createForm( new ModeloType(), $modelo);
        
        $formulario->handleRequest($peticion);
        
        if($formulario->isValid()){
            $modelo->setMarca($objetoMarca);
            
            $em->persist($modelo);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'El Modelo '.$modelo->getNombre().' ha sido registrado correctamente');

            return $this->redirect($this->generateUrl('recepcion_crear_motor_modelo', array('marca'=> $marca)));
        }
        
        return $this->render('RecepcionBundle:Default:crearMotorModelo.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'modelos' => $em->getRepository('MotorBundle:Modelo')->findModelos($objetoMarca->getID()),
                    'marca' => $objetoMarca
        ));
    }
    
//Creación de un Cliente por parte del recepcionista
    public function crearMotorModeloSerieAction($marca, $modelo)
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('slug' => $marca));
        $objetoModelo = $em->getRepository('MotorBundle:Modelo')->findOneBy(array('slug'=>$modelo, 'marca'=>$objetoMarca->getId()));
        
        $serie = new Serie();
        $formulario = $this->createForm(new SerieType(), $serie);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $serie->setMarca($objetoMarca);
            $serie->setModelo($objetoModelo);
            
            $em->persist($serie);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'La serie '.$serie->getNombre().' ha sido registrada correctamente');

            return $this->redirect($this->generateUrl('recepcion_crear_motor_modelo_serie',
                    array(
                        'marca'=> $marca, 
                        'modelo' =>$objetoModelo->getSlug()
                    )));
        }
        
        return $this->render('RecepcionBundle:Default:crearMotorModeloSerie.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'series' => $em->getRepository('MotorBundle:Serie')->findSeries($objetoModelo),
                    'marca' => $objetoMarca,
                    'modelo' => $objetoModelo
                ));
    }
    
 //Creación de un Cliente por parte del recepcionista
    public function agregarClienteAction()
    {
        return $this->render('RecepcionBundle:Default:agregarCliente.html.twig');
    }
}
