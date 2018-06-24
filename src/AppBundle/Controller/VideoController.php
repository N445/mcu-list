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

        $videos = $em->getRepository('AppBundle:Video')->findAll();

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
        $form  = $this->createForm('AppBundle\Form\VideoType', $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $video->setDate(DateTime::createFromFormat('Y', $video->getDate()));

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
        $video->setDate($video->getDate()->format('Y'));
        $deleteForm = $this->createDeleteForm($video);
        $editForm   = $this->createForm('AppBundle\Form\VideoType', $video);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $video->setDate(DateTime::createFromFormat('Y', $video->getDate()));
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
}