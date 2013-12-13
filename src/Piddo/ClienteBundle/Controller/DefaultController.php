<?php

namespace Piddo\ClienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\ClienteBundle\Entity\Cliente;
use Piddo\ClienteBundle\Form\ClienteType;

class DefaultController extends Controller
{
    public function registroAction()
    {
        $peticion = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        $cliente = new Cliente();
        $formulario = $this->createForm(new ClienteType(), $cliente);
        
        $formulario->handleRequest($peticion);
        
        if($formulario->isValid()){
            $em->persist($cliente);
            $em->flush();

           $this->get('session')->getFlashBag()->add('info', 'Se ha registrado correctamente');


            return $this->redirect($this->generateUrl('admin_clientes'));
        
        }
        
        return $this->render('ClienteBundle:Default:clientes.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'clientes' => $em->getRepository('ClienteBundle:Cliente')->findAll()
                ));
    }
}
