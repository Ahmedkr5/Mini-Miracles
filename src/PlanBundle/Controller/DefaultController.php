<?php

namespace PlanBundle\Controller;

use eventBundle\Entity\enfant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Plan/Default/index.html.twig');
    }

}
