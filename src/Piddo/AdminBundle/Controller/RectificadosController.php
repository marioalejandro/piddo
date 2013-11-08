<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\TallerBundle\Entity\GrupoRectificado;
use Piddo\AdminBundle\Form\GrupoRectificadoType;
use Piddo\TallerBundle\Entity\Rectificado;
use Piddo\AdminBundle\Form\RectificadoType;


use Piddo\MotorBundle\Entity\Marca;
use Piddo\MotorBundle\Entity\Modelo;
use Piddo\MotorBundle\Entity\Serie;
use Piddo\AdminBundle\Form\MarcaType;
use Piddo\AdminBundle\Form\ModeloType;
use Piddo\AdminBundle\Form\SerieType;

class RectificadosController extends Controller
{
    public function rectificadosAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        
        
        $rectificado = new Rectificado();
        $formulario2 = $this->createForm(new RectificadoType(), $rectificado);
        $formulario2->handleRequest($peticion);
        if($formulario2->isValid()){
            $em->persist($rectificado);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'El Rectificado '.$rectificado->getNombre().' ha sido registrado correctamente');
            return $this->redirect($this->generateUrl('admin_rectificados'));
        }
        
        
        $grupoRectificado = new GrupoRectificado();
        $formulario = $this->createForm(new GrupoRectificadoType(), $grupoRectificado);
        $formulario->handleRequest($peticion);
        if($formulario->isValid()){
            $em->persist($grupoRectificado);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'El Grupo '.$grupoRectificado->getNombre().' ha sido registrado correctamente');
            return $this->redirect($this->generateUrl('admin_rectificados'));
        }
        
        return $this->render('AdminBundle:Default:rectificados.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'formulario2' => $formulario2->createView(),
                    'gruposRectificado' => $em->getRepository('TallerBundle:GrupoRectificado')->findAll()
                ));
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
}
