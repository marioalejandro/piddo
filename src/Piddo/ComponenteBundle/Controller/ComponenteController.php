<?php

namespace Piddo\ComponenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\ComponenteBundle\Entity\Componente;
use Piddo\ComponenteBundle\Entity\GrupoComponente;
use Piddo\ComponenteBundle\Entity\PerfilComponente;
use Piddo\ComponenteBundle\Form\ComponenteType;
use Piddo\ComponenteBundle\Form\GrupoComponenteType;
use Piddo\ComponenteBundle\Form\SerieComponentesType;

class ComponenteController extends Controller
{
    public function universoAction()
    {
        /***************************************
         * 	OBTENCION DE DATOS DEL MODELO
         ***************************************/

        $em = $this->getDoctrine()->getManager();
        $universo = $em->getRepository('ComponenteBundle:GrupoComponente')->findAll();

        /***************************************
         * 	FORMULARIO GRUPO COMPONENTE
         ***************************************/

        $peticion = $this->getRequest(); 
        $gComponente = new GrupoComponente();
        $formGrupoComponente = $this->createForm(new GrupoComponenteType(), $gComponente);       

        // Validacion de formulario
        $formGrupoComponente->handleRequest($peticion);
        if($formGrupoComponente->isValid())
        {
            //Persistencia
            $em->persist($gComponente);
            $em->flush();
            //Mensaje Flash
            $this->get('session')->getFlashBag()
            	->add('info', 'El Grupo '.$gComponente->getNombre().' ha sido registrado correctamente');
            //Redireccionamiento	
            return $this->redirect($this->generateUrl('componente_universo'));
        }
		
        /***************************************
         * 	FORMULARIO COMPONENTE
         ***************************************/

        $componente = new Componente();
        $formComponente = $this->createForm(new ComponenteType(), $componente);

        // Validacion de formulario
        $formComponente->handleRequest($peticion);
        if($formComponente->isValid()){
            //Persistencia
            $em->persist($componente);
            $em->flush();
            //Mensaje Flash
            $this->get('session')->getFlashBag()
                ->add('info', 'El componente '.$componente->getNombre().' ha sido registrado correctamente');
            //Redireccionamiento
            return $this->redirect($this->generateUrl('componente_universo'));
        }
		
        /***************************************
         * 	RETURN DEFAULT
         ***************************************/
		 
        return $this->render('ComponenteBundle:Default:componenteUniverso.html.twig', 
            array(
                'formComponente' => $formComponente->createView(),
                'formGrupoComponente' => $formGrupoComponente->createView(),
                'universo' => $universo,
            ));
    }
    
    public function listaComponentesAction($grupo)
    {
        $em = $this->getDoctrine()->getManager();
        $componentes = $em->getRepository('ComponenteBundle:Componente')
                                ->findBy(array('grupoComponente' => $grupo));
        return $this->render('ComponenteBundle:Includes:listaComponentes.html.twig', 
            array(
                'componentes' => $componentes,
            ));
    }
    
    public function perfilAction($serie)
    { 
        
        /***************************************
         * 	OBTENCION DE DATOS DEL MODELO
         ***************************************/
        $em = $this->getDoctrine()->getManager();
        /**************************************************************
         * FORMULARIO PERFIL COMPONENTES
         **************************************************************/
        
        $peticion = $this->getRequest();
        
        //1.- Rescatar el objeto serie
        $serie = $em->getRepository('MotorBundle:Serie')->findOneBy(array('id'=>$serie));
        
        //2.- Creacion de los objetos PerfilComponente
        $gruposComponente = $em->getRepository('ComponenteBundle:GrupoComponente')->findAll();
        $perfilComponente = $em->getRepository('ComponenteBundle:PerfilComponente')->findBy(array('serie'=>$serie->getId()));

        foreach ($gruposComponente as $gc)
        {
            //Se revisa cada componente en cada grupo de componentes
            $componentes = $gc->getComponentes();
            foreach ($componentes as $c)
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
        /**************************************************************
         *      RETURN POR DEFECTO
         **************************************************************/
       
        return $this->render('ComponenteBundle:Default:perfilComponentes.html.twig', 
            array(
                'form' => $form->createView(),
                'gruposComponente' => $gruposComponente,
                'serie' => $serie,
            ));
    }
}
