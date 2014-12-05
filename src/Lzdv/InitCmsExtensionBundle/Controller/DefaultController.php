<?php

namespace Lzdv\InitCmsExtensionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LzdvInitCmsExtensionBundle:Default:index.html.twig', array('name' => $name));
    }
}
