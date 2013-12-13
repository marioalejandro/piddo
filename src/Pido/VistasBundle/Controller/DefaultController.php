<?php

namespace Pido\VistasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VistasBundle:Default:index.html.twig', array('name' => $name));
    }
}
