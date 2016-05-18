<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\BookUniq;
use AppBundle\Form\BookUniqType;

/**
 * BookUniq controller.
 *
 * @Route("/bookuniq")
 */
class BookUniqController extends Controller
{
    /**
     * Lists all BookUniq entities.
     *
     * @Route("/", name="bookuniq_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bookUniqs = $em->getRepository('AppBundle:BookUniq')->findAll();

        return $this->render('bookuniq/index.html.twig', array(
            'bookUniqs' => $bookUniqs,
        ));
    }

    /**
     * Creates a new BookUniq entity.
     *
     * @Route("/new", name="bookuniq_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bookUniq = new BookUniq();
        $form = $this->createForm('AppBundle\Form\BookUniqType', $bookUniq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookUniq);
            $em->flush();

            return $this->redirectToRoute('bookuniq_show', array('id' => $bookUniq->getCode()));
        }

        return $this->render('bookuniq/new.html.twig', array(
            'bookUniq' => $bookUniq,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BookUniq entity.
     *
     * @Route("/{id}", name="bookuniq_show")
     * @Method("GET")
     */
    public function showAction(BookUniq $bookUniq)
    {
        $deleteForm = $this->createDeleteForm($bookUniq);

        return $this->render('bookuniq/show.html.twig', array(
            'bookUniq' => $bookUniq,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BookUniq entity.
     *
     * @Route("/{id}/edit", name="bookuniq_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BookUniq $bookUniq)
    {
        $deleteForm = $this->createDeleteForm($bookUniq);
        $editForm = $this->createForm('AppBundle\Form\BookUniqType', $bookUniq);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookUniq);
            $em->flush();

            return $this->redirectToRoute('bookuniq_edit', array('id' => $bookUniq->getCode()));
        }

        return $this->render('bookuniq/edit.html.twig', array(
            'bookUniq' => $bookUniq,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BookUniq entity.
     *
     * @Route("/{id}", name="bookuniq_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BookUniq $bookUniq)
    {
        $form = $this->createDeleteForm($bookUniq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bookUniq);
            $em->flush();
        }

        return $this->redirectToRoute('bookuniq_index');
    }

    /**
     * Creates a form to delete a BookUniq entity.
     *
     * @param BookUniq $bookUniq The BookUniq entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BookUniq $bookUniq)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookuniq_delete', array('id' => $bookUniq->getCode())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
