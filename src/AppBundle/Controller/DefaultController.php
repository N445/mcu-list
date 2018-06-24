<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homepageAction()
    {
        $videos  = $this->getDoctrine()->getManager()->getRepository('AppBundle:Video')->getVideoByOrdre();
        $em      = $this->getDoctrine()->getManager();
        $slugify = new Slugify();
        /** @var Video $video */
        foreach ($videos as $video) {
            $video->setTypeClass($slugify->slugify($video->getType()));
            $em->persist($video);
        }
        $em->flush();
        return $this->render('@App/default/homepage.html.twig', [
            'videos' => $videos,
        ]);
    }


    public function adminAction()
    {
        return $this->render('@App/admin/admin.html.twig');
    }
}
