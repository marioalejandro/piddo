<?php

namespace Piddo\MotorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MotorBundle:Default:index.html.twig', array('name' => $name));
    }
}
