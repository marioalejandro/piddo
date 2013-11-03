<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Piddo\MotorBundle\Entity\Marca;
use Piddo\AdminBundle\Form\MarcaType;

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

           /* $this->get('session')->getFlashBag()->add('info', 'Se ha registrado correctamente');
            $token = new UsernamePasswordToken(
                    $usuario,
                    $usuario->getPassword(),
                    'fronted',
                    $usuario->getRoles()
                    );
            $this->container->get('security.context')->setToken($token);*/

            return $this->redirect($this->generateUrl('admin_marcas'));
        
        }
        
        return $this->render('AdminBundle:Default:marcas.html.twig', 
                array(
                    'formulario' => $formulario->createView(),
                    'marcas' => $em->getRepository('MotorBundle:Marca')->findAll()
                ));
    }
}
