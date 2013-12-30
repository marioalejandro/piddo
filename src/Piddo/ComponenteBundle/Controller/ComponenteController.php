<?php

namespace Piddo\ComponenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\ComponenteBundle\Entity\Componente;
use Piddo\ComponenteBundle\Entity\GrupoComponente;
use Piddo\ComponenteBundle\Form\ComponenteType;
use Piddo\ComponenteBundle\Form\GrupoComponenteType;

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
        
}
