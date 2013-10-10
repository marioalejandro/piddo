<?php

namespace Piddo\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function portadaGerenciaAction()
    {
        return $this->render('AdminBundle:Default:portadaGerencia.html.twig');
    }
    public function marcasAction()
    {
        return $this->render('AdminBundle:Default:marcas.html.twig');
    }
}
