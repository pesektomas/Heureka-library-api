<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Locality;
use AppBundle\Form\LocalityType;

/**
 * Locality controller.
 *
 * @Route("/locality")
 */
class LocalityController extends Controller
{
    /**
     * Lists all Locality entities.
     *
     * @Route("/", name="locality_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $localities = $em->getRepository('AppBundle:Locality')->findAll();

        return $this->render('locality/index.html.twig', array(
            'localities' => $localities,
        ));
    }

    /**
     * Creates a new Locality entity.
     *
     * @Route("/new", name="locality_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $locality = new Locality();
        $form = $this->createForm('AppBundle\Form\LocalityType', $locality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locality);
            $em->flush();

            return $this->redirectToRoute('locality_show', array('id' => $locality->getId()));
        }

        return $this->render('locality/new.html.twig', array(
            'locality' => $locality,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Locality entity.
     *
     * @Route("/{id}", name="locality_show")
     * @Method("GET")
     */
    public function showAction(Locality $locality)
    {
        $deleteForm = $this->createDeleteForm($locality);

        return $this->render('locality/show.html.twig', array(
            'locality' => $locality,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Locality entity.
     *
     * @Route("/{id}/edit", name="locality_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Locality $locality)
    {
        $deleteForm = $this->createDeleteForm($locality);
        $editForm = $this->createForm('AppBundle\Form\LocalityType', $locality);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locality);
            $em->flush();

            return $this->redirectToRoute('locality_edit', array('id' => $locality->getId()));
        }

        return $this->render('locality/edit.html.twig', array(
            'locality' => $locality,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Locality entity.
     *
     * @Route("/{id}", name="locality_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Locality $locality)
    {
        $form = $this->createDeleteForm($locality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($locality);
            $em->flush();
        }

        return $this->redirectToRoute('locality_index');
    }

    /**
     * Creates a form to delete a Locality entity.
     *
     * @param Locality $locality The Locality entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Locality $locality)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('locality_delete', array('id' => $locality->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
