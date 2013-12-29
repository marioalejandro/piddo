<?php

namespace Piddo\ComponenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ComponenteBundle:Default:index.html.twig', array('name' => $name));
    }
}
