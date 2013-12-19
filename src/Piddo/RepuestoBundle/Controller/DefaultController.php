<?php

namespace Piddo\RepuestoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
/*Portada del presupuesto*/ 
    public function repuestoAction()
    {
        return $this->render('RepuestoBundle:Default:repuestoInicio.html.twig');
    }
    
/*Lista de solicitudes para aprobar*/
    public function listaSolicitudesAction()
    {
        return $this->render('RepuestoBundle:Default:listaSolicitudes.html.twig');
    }
    
/*Lista de los presupuestos disponibles*/    
     public function listaPresupuestosAction()
    {
        return $this->render('RepuestoBundle:Default:presupuestos.html.twig');
    }
    
/*Lista de los presupuestos disponibles*/    
     public function listaAction()
    {
        return $this->render('RepuestoBundle:Default:listaRepuestos.html.twig');
    }
}
