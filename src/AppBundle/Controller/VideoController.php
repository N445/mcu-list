<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Video controller.
 *
 */
class VideoController extends Controller
{
    /**
     * Lists all video entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('AppBundle:Video')->getVideoByOrdreAdmin();

        return $this->render('video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    /**
     * Creates a new video entity.
     *
     */
    public function newAction(Request $request)
    {

        $video = new Video();
        $video->setOrdre($this->getDoctrine()->getManager()->getRepository('AppBundle:Video')->getMaxOrderValue()->getOrdre() + 10);
        $video->setActive(true);
        $form = $this->createForm('AppBundle\Form\VideoType', $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $video->setDuration(self::durationParser($video));
            ($video->getDate()) ? $video->setDate(DateTime::createFromFormat('Y', $video->getDate())) : null;
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('video_show', ['id' => $video->getId()]);
        }

        return $this->render('video/new.html.twig', [
            'video' => $video,
            'form'  => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a video entity.
     *
     */
    public function showAction(Video $video)
    {
        $deleteForm = $this->createDeleteForm($video);

        return $this->render('video/show.html.twig', [
            'video'       => $video,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing video entity.
     *
     */
    public function editAction(Request $request, Video $video)
    {

        ($video->getDate()) ? $video->setDate($video->getDate()->format('Y')) : null;
        $deleteForm = $this->createDeleteForm($video);
        $editForm   = $this->createForm('AppBundle\Form\VideoType', $video);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $video->setDuration(self::durationParser($video));
            ($video->getDate()) ? $video->setDate(DateTime::createFromFormat('Y', $video->getDate())) : null;
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('video_edit', ['id' => $video->getId()]);
        }

        return $this->render('video/edit.html.twig', [
            'video'       => $video,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a video entity.
     *
     */
    public function deleteAction(Request $request, Video $video)
    {
        $form = $this->createDeleteForm($video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush();
        }

        return $this->redirectToRoute('video_index');
    }

    /**
     * Creates a form to delete a video entity.
     *
     * @param Video $video The video entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Video $video)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('video_delete', ['id' => $video->getId()]))
                    ->setMethod('DELETE')
                    ->getForm()
            ;
    }


    private function durationParser(Video $video)
    {
        $durationExploded = explode('h', strtolower($video->getDuration()));

        if (count($durationExploded) == 1) {
            return (int)$video->getDuration();
        }
        $heures  = $durationExploded[0];
        $minutes = $durationExploded[1];

        (strlen($minutes) == 1) ? $minutes = '0' . $minutes : $minutes = $minutes;
        (strlen($minutes) == 0) ? $minutes = 0 : $minutes = $minutes;
        $minutes = $minutes + $heures * 60;
        return $minutes;
    }
}
