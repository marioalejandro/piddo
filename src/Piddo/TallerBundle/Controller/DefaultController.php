<?php

namespace Piddo\TallerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TallerBundle:Default:index.html.twig', array('name' => $name));
    }
}
