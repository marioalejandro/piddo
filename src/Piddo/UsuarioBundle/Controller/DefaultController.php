<?php

namespace Piddo\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\UsuarioBundle\Entity\Usuario;
use Piddo\UsuarioBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsuarioBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function privadoAction()
    {
        return $this->render('UsuarioBundle:Default:privado.html.twig');
    }
    public function gerenteAction()
    {
        return $this->render('UsuarioBundle:Default:gerente.html.twig');
    }
    public function jefeTallerAction()
    {
        return $this->render('UsuarioBundle:Default:jefetaller.html.twig');
    }
    public function recepcionAction()
    {
        return $this->render('UsuarioBundle:Default:recepcion.html.twig');
    }
    
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
        
        $usuario->setPassword($passwordCodificado);
        $usuario->setFechaIngreso(new \DateTime('now'));
        $usuario->setExiste(true);
        $usuario->setCargo('ROLE_RECEPCION');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();
     
       /* $this->get('session')->getFlashBag()->add('info', 'Se ha registrado correctamente');
        $token = new UsernamePasswordToken(
                $usuario,
                $usuario->getPassword(),
                'fronted',
                $usuario->getRoles()
                );
        $this->container->get('security.context')->setToken($token);*/
        
        return $this->redirect($this->generateUrl('usuario_homepage', array(
            'name' => 'seba')
             ));
        
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
