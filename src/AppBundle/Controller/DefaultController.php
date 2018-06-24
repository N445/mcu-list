<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homepageAction()
    {
        return $this->render('@App/default/homepage.html.twig', [

        ]);
    }


    public function adminAction()
    {
        return $this->render('@App/admin/admin.html.twig');
    }
}
