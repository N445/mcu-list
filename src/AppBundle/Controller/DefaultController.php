<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homepageAction()
    {
        $videos = $this->getDoctrine()->getManager()->getRepository('AppBundle:Video')->getVideoByOrdre();
        return $this->render('@App/default/homepage.html.twig', [
            'videos' => $videos,
            'duree'  => self::calculeDuration($videos)
            ]
        );
    }

    public function adminAction()
    {
        return $this->render('@App/admin/admin.html.twig');
    }

    private function calculeDuration($videos)
    {
        $dureFilm         = 0;
        $dureSerie        = 0;
        $dureCourtMetrage = 0;
        $dureTotal        = 0;
        /** @var Video $video */
        foreach ($videos as $video) {
            $dureTotal = $dureTotal + $video->getDuration();
            switch ($video->getType()) {
                case Video::TYPE_FILM:
                    $dureFilm = $dureFilm + $video->getDuration();
                    break;
                case Video::TYPE_SERIE:
                    $dureSerie = $dureSerie + $video->getDuration();
                    break;
                case Video::TYPE_COURT_METRAGE:
                    $dureCourtMetrage = $dureCourtMetrage + $video->getDuration();
                    break;
            }
        }
        return [
            'dureFilm'         => $dureFilm,
            'dureSerie'        => $dureSerie,
            'dureCourtMetrage' => $dureCourtMetrage,
            'dureTotal'        => $dureTotal,
        ];
    }

}
