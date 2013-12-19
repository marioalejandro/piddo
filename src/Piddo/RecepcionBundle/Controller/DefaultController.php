<?php

namespace Piddo\RecepcionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

 //Home page del recepcionista
    public function portadaRecepcionAction()
    {
        return $this->render('RecepcionBundle:Default:portadaRecepcion.html.twig');
    }
    
 //Creación de un presupuesto por parte del recepcionista
    public function crearPresupuestoAction()
    {
        return $this->render('RecepcionBundle:Default:crearPresupuesto.html.twig');
    }
    
 //Creación de un Motor por parte del recepcionista
    public function crearMotorAction()
    {
        return $this->render('RecepcionBundle:Default:crearMotor.html.twig');
    }
    
 //Creación de un Motor por parte del recepcionista
    public function agregarClienteAction()
    {
        return $this->render('RecepcionBundle:Default:agregarCliente.html.twig');
    }
}
