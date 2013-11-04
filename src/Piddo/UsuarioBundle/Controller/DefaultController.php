<?php

namespace Piddo\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\UsuarioBundle\Entity\Usuario;
use Piddo\UsuarioBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function registroAction()
    {
        $peticion = $this->getRequest();
        
        $usuario = new Usuario();
        $formulario = $this->createForm(new UsuarioType(), $usuario);
        
        $formulario->handleRequest($peticion);
        
        if($formulario->isValid()){
            $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
            $usuario->setSalt(md5(time()));
            $passwordCodificado = $encoder->encodePassword(
                    $usuario->getPassword(),
                    $usuario->getSalt()
                    );
            //Borrar estas linea y cambiar de plaintext a la otra mierda
            $usuario->setSalt('');
            $passwordCodificado = $usuario->getPassword();
            //hasta aca
            $usuario->setPassword($passwordCodificado);
            $usuario->setFechaIngreso(new \DateTime('now'));
            $usuario->setExiste(true);
            $usuario->setCargo('subordinado');
            $usuario->setRoles(array('ROLE_ADMIN'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

           $this->get('session')->getFlashBag()->add('info', 'Se ha registrado correctamente');


            return $this->redirect($this->generateUrl('usuario_registro'));
        
        }
        
        return $this->render('UsuarioBundle:Default:registro.html.twig', 
                array('formulario' => $formulario->createView())
                );
    }
    
    public function loginAction()
    {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        
        $error = $peticion->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR,
                $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
                );
        
        return $this->render('UsuarioBundle:Default:login.html.twig',
                array('error' => $error));
    }
}
