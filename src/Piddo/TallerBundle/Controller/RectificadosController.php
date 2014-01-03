<?php

namespace Piddo\TallerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\TallerBundle\Entity\GrupoRectificado;
use Piddo\AdminBundle\Form\GrupoRectificadoType;
use Piddo\TallerBundle\Entity\Rectificado;
use Piddo\AdminBundle\Form\RectificadoType;
use Piddo\TallerBundle\Entity\PerfilRectificado;
use Piddo\TallerBundle\Form\SerieRectificadoType;


class RectificadosController extends Controller
{
   public function universoAction()
    {
        //***************************************
        //* 	OBTENCION DE DATOS DEL MODELO
        //***************************************

        $em = $this->getDoctrine()->getManager();
        $universo = $em->getRepository('TallerBundle:GrupoRectificado')->findAll();

        //***************************************
        //* 	FORMULARIO GRUPO CRECTIFICADO
        //***************************************/

        $peticion = $this->getRequest(); 
        $gRectificado = new GrupoRectificado();
        $formGrupoRectificado = $this->createForm(new GrupoRectificadoType(), $gRectificado);       

        // Validacion de formulario
        $formGrupoRectificado->handleRequest($peticion);
        if($formGrupoRectificado->isValid())
        {
            //Persistencia
            $em->persist($gRectificado);
            $em->flush();
            //Mensaje Flash
            $this->get('session')->getFlashBag()
            	->add('info', 'El Grupo '.$gRectificado->getNombre().' ha sido registrado correctamente');
            //Redireccionamiento	
            return $this->redirect($this->generateUrl('rectificado_universo'));
        }
		
        //***************************************
        //* 	FORMULARIO RECTIFICADO
        //***************************************/

        $rectificado = new Rectificado();
        $formRectificado = $this->createForm(new RectificadoType(), $rectificado);

        // Validacion de formulario
        $formRectificado->handleRequest($peticion);
        if($formRectificado->isValid()){
            //Persistencia
            $em->persist($rectificado);
            $em->flush();
            //Mensaje Flash
            $this->get('session')->getFlashBag()
                ->add('info', 'El trabajo '.$rectificado->getNombre().' ha sido registrado correctamente');
            //Redireccionamiento
            return $this->redirect($this->generateUrl('rectificado_universo'));
        }
		
        //***************************************
        //* 	RETURN DEFAULT
        //***************************************/
		 
        return $this->render('TallerBundle:Default:rectificadoUniverso.html.twig', 
            array(
                'formRectificado' => $formRectificado->createView(),
                'formGrupoRectificado' => $formGrupoRectificado->createView(),
                'universo' => $universo,
            ));
    }
    
    public function listaRectificadosAction($grupo)
    {
        $em = $this->getDoctrine()->getManager();
        $rectificados = $em->getRepository('TallerBundle:Rectificado')
                                ->findBy(array('grupoRectificado' => $grupo));
        return $this->render('TallerBundle:Includes:listaRectificados.html.twig', 
            array(
                'rectificados' => $rectificados,
            ));
    }
    
    public function perfilAction($serie)
    { 
        
        //***************************************
        //* 	OBTENCION DE DATOS DEL MODELO
        //***************************************/
        $em = $this->getDoctrine()->getManager();
        //**************************************************************
        //* FORMULARIO PERFIL RECTIFICADO
        //**************************************************************/
        
        $peticion = $this->getRequest();
        
        //1.- Rescatar el objeto serie
        $serie = $em->getRepository('MotorBundle:Serie')->findOneBy(array('id'=>$serie));
        
        //2.- Creacion de los objetos PerfilComponente
        $gruposRectificado = $em->getRepository('TallerBundle:GrupoRectificado')->findAll();
        $perfilRectificado = $em->getRepository('TallerBundle:PerfilRectificado')->findBy(array('serie'=>$serie->getId()));

        foreach ($gruposRectificado as $gr)
        {
            //Se revisa cada rectificado en cada grupo de rectificados
            $rectificados = $gr->getRectificados();
            foreach ($rectificados as $r)
            {
                $nuevo = true;
                //Se compara cada rectificado con el perfil de la serie
                foreach ($perfilRectificado as $pr)
                {
                    if($r == $pr->getRectificado())
                    {
                        $nuevo = false;
                    }
                }
                if($nuevo)
                {
                    $nuevoPerfil = new PerfilRectificado();
                    $nuevoPerfil->setRectificado($r);
                    $nuevoPerfil->setSerie($serie);
                    //3.- Agregar los perfiles a la serie
                    $serie->getPerfilRectificados()->add($nuevoPerfil);
                }
            }
        }

        //4.- Creacion de formulario
        $form = $this->createForm(
                new SerieRectificadoType(), 
                $serie, 
                array(
                    'data' => $serie
                )
            
        );/**/
        
        $form->handleRequest($peticion);
        
        if($form->isValid()){
            $em->persist($serie);
            $em->flush();
            
            $mensaje ='La serie se ha modificado correctamente';

           $this->get('session')->getFlashBag()->add('info', $mensaje);


           // return $this->redirect($this->generateUrl('admin_clientes'));
        
        }
        //**************************************************************
        //*      RETURN POR DEFECTO
        //**************************************************************/
       
        return $this->render('TallerBundle:Default:perfilRectificados.html.twig', 
            array(
                'form' => $form->createView(),
                'gruposRectificado' => $gruposRectificado,
                'serie' => $serie,
            ));
    }
}
