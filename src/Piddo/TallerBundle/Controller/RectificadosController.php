<?php

namespace Piddo\TallerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\TallerBundle\Entity\GrupoRectificado;
use Piddo\AdminBundle\Form\GrupoRectificadoType;
use Piddo\TallerBundle\Entity\Rectificado;
use Piddo\AdminBundle\Form\RectificadoType;


class RectificadosController extends Controller
{
   /* public function rectificadosAction()
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
            }*/
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
        //* FORMULARIO PERFIL COMPONENTES
        //**************************************************************/
        
        $peticion = $this->getRequest();
        
        //1.- Rescatar el objeto serie
        $serie = $em->getRepository('MotorBundle:Serie')->findOneBy(array('id'=>$serie));
        
        //2.- Creacion de los objetos PerfilComponente
        $gruposComponente = $em->getRepository('TallerBundle:GrupoRectificado')->findAll();
        $perfilComponente = $em->getRepository('TallerBundle:PerfilComponente')->findBy(array('serie'=>$serie->getId()));

        foreach ($gruposComponente as $gc)
        {
            //Se revisa cada componente en cada grupo de componentes
            $rectificados = $gc->getComponentes();
            foreach ($rectificados as $c)
            {
                $nuevo = true;
                //Se compara cada componente con el perfil de la serie
                foreach ($perfilComponente as $pc)
                {
                    if($c == $pc->getComponente())
                    {
                        $nuevo = false;
                    }
                }
                if($nuevo)
                {
                    $nuevoPerfil = new PerfilComponente();
                    //$nuevoPerfil->setMaximo(0);
                    $nuevoPerfil->setComponente($c);
                    $nuevoPerfil->setSerie($serie);
                    //3.- Agregar los perfiles a la serie
                    $serie->getPerfilComponentes()->add($nuevoPerfil);
                }
            }
        }

        //4.- Creacion de formulario
        $form = $this->createForm(
                new SerieComponentesType(), 
                $serie, 
                array(
                    'data' => $serie
                )
            
        );/**/
        
        $form->handleRequest($peticion);
        
        if($form->isValid()){
            $em->persist($serie);
            $em->flush();
            
            $mensaje ='La serie se ha modeificado correctamente';

           $this->get('session')->getFlashBag()->add('info', $mensaje);


            //return $this->redirect($this->generateUrl('admin_clientes'));
        
        }
        //**************************************************************
        //*      RETURN POR DEFECTO
        //**************************************************************/
       
        return $this->render('TallerBundle:Default:perfilComponentes.html.twig', 
            array(
                'form' => $form->createView(),
                'gruposComponente' => $gruposComponente,
                'serie' => $serie,
            ));
    }
}
