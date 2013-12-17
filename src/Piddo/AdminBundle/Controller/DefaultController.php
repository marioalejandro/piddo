<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\MotorBundle\Entity\Marca;
use Piddo\MotorBundle\Entity\Modelo;
use Piddo\MotorBundle\Entity\Serie;
use Piddo\MotorBundle\Entity\Pieza;
use Piddo\MotorBundle\Entity\GrupoPieza;
use Piddo\MotorBundle\Entity\ColPiezas;
use Piddo\AdminBundle\Form\MarcaType;
use Piddo\AdminBundle\Form\ModeloType;
use Piddo\AdminBundle\Form\SerieType;
use Piddo\AdminBundle\Form\PiezaType;
use Piddo\AdminBundle\Form\GrupoPiezaType;


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
      public function borrarModeloAction($marca, $modelo)
      {
          $em = $this->getDoctrine()->getManager();
          $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('id' => $marca));
 
          $em->getRepository('MotorBundle:Modelo')->deleteModelo($modelo);
            $this->get('session')->getFlashBag()->add('info', 'El modelo ha sido borrado');
          return $this->redirect($this->generateUrl('admin_modelos',array('marca'=> $objetoMarca->getSlug())));
      }
    public function borrarSerieAction($marca, $modelo,$serie)
    {
        $em = $this->getDoctrine()->getManager();
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('id' => $marca));
        $objetoModelo = $em->getRepository('MotorBundle:Modelo')->findOneBy(array('id' => $modelo));
        
        $em->getRepository('MotorBundle:Serie')->deleteSerie($serie);
        $this->get('session')->getFlashBag()->add('info', 'La serie ha sido borrada');
        return $this->redirect($this->generateUrl('admin_series',
              array(
                  'marca'=> $objetoMarca->getSlug(), 
                  'modelo' =>$objetoModelo->getSlug()
              )));
      }
      
       public function modelosAction($marca)
       {
           
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('slug' => $marca));
        
        $modelo = new Modelo();
        $formulario = $this->createForm(new ModeloType(), $modelo);
        
        $formulario->handleRequest($peticion);
        
        
        if($formulario->isValid()){
            $modelo->setMarca($objetoMarca);
            
            $em->persist($modelo);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'El Modelo '.$modelo->getNombre().' ha sido registrado correctamente');

            return $this->redirect($this->generateUrl('admin_modelos',array('marca'=> $marca)));
        }
        return $this->render('AdminBundle:Default:modelos.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'modelos' => $em->getRepository('MotorBundle:Modelo')->findModelos($objetoMarca->getID()),
                    'marca' => $objetoMarca
                ));
      }
       public function seriesAction($marca, $modelo)
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

            return $this->redirect($this->generateUrl('admin_series',
                    array(
                        'marca'=> $marca, 
                        'modelo' =>$objetoModelo->getSlug()
                    )));
        }
        return $this->render('AdminBundle:Default:series.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'series' => $em->getRepository('MotorBundle:Serie')->findSeries($objetoModelo),
                    'marca' => $objetoMarca,
                    'modelo' => $objetoModelo
                ));
      }
      
    public function piezasAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        
        
        $grupoPieza = new GrupoPieza();
        $formulario2 = $this->createForm(new GrupoPiezaType(), $grupoPieza);
        $formulario2->handleRequest($peticion);
        if($formulario2->isValid()){
            $em->persist($grupoPieza);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'El Grupo '.$grupoPieza->getNombre().' ha sido registrado correctamente');
            return $this->redirect($this->generateUrl('admin_piezas'));
        }
        
        
        $pieza = new Pieza();
        $formulario = $this->createForm(new PiezaType(), $pieza);
        $formulario->handleRequest($peticion);
        if($formulario->isValid()){
            $em->persist($pieza);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'La Pieza '.$pieza->getNombre().' ha sido registrado correctamente');
            return $this->redirect($this->generateUrl('admin_piezas'));
        }
        
        return $this->render('AdminBundle:Default:piezas.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'formulario2' => $formulario2->createView(),
                    'gruposPieza' => $em->getRepository('MotorBundle:GrupoPieza')->findAll()
                ));
    }
    public function listaPiezasAction($grupo)
            {
                $em = $this->getDoctrine()->getManager();
                $piezas = $em->getRepository('MotorBundle:Pieza')->findBy(array('grupoPieza' => $grupo));
                return $this->render('AdminBundle:Default:listaPiezas.html.twig', 
                    array(
                        'piezas' => $piezas
                    ));
            }
            
    public function ColPiezasAction($marca, $modelo, $serie)
        {
            $peticion = $this->getRequest();
            
            $em = $this->getDoctrine()->getManager();


            $grupoPieza = new GrupoPieza();
            $formulario2 = $this->createForm(new GrupoPiezaType(), $grupoPieza);
            $formulario2->handleRequest($peticion);
            if($formulario2->isValid()){
                $em->persist($grupoPieza);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'El Grupo '.$grupoPieza->getNombre().' ha sido registrado correctamente');
                return $this->redirect($this->generateUrl('admin_piezas'));
                
                
            
            $em = $this->getDoctrine()->getManager();
            $objetoMarca = $em->getRepository('MotorBundle:Marca')->findOneBy(array('id' => $marca));
            $objetoModelo = $em->getRepository('MotorBundle:Modelo')->findOneBy(array('id' => $modelo));

            $em->getRepository('MotorBundle:Serie')->deleteSerie($serie);
            $this->get('session')->getFlashBag()->add('info', 'La serie ha sido borrada');
            return $this->redirect($this->generateUrl('admin_series',
                  array(
                      'marca'=> $objetoMarca->getSlug(), 
                      'modelo' =>$objetoModelo->getSlug(),
                      'gruposPieza' => $em->getRepository('MotorBundle:GrupoPieza')->findAll()
                  )));
        }
      
}
