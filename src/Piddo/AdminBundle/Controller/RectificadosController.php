<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\TallerBundle\Entity\GrupoRectificado;
use Piddo\AdminBundle\Form\GrupoRectificadoType;
use Piddo\TallerBundle\Entity\Rectificado;
use Piddo\AdminBundle\Form\RectificadoType;


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
    public function listaRectificadosAction($grupo)
            {
                $em = $this->getDoctrine()->getManager();
                $rectificados = $em->getRepository('TallerBundle:Rectificado')->findBy(array('grupoRectificado' => $grupo));
                return $this->render('AdminBundle:Default:listaRect.html.twig', 
                    array(
                        'rectificados' => $rectificados
                    ));
            }
}
