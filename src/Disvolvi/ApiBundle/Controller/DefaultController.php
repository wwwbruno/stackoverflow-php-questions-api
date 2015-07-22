<?php

namespace Disvolvi\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DisvolviApiBundle:Default:index.html.twig');
    }
}
