<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homepageAction()
    {
        $videos = $this->getDoctrine()->getManager()->getRepository('AppBundle:Video')->getVideoByOrdre();
        return $this->render('@App/default/homepage.html.twig', [
            'videos' => $videos,
        ]);
    }


    public function adminAction()
    {
        return $this->render('@App/admin/admin.html.twig');
    }
}
