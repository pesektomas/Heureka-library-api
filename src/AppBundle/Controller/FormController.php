<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Form;
use AppBundle\Form\FormType;

/**
 * Form controller.
 *
 * @Route("/form")
 */
class FormController extends Controller
{
    /**
     * Lists all Form entities.
     *
     * @Route("/", name="form_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $forms = $em->getRepository(Form::class)->findAll();

        return $this->render('form/index.html.twig', array(
            'forms' => $forms,
        ));
    }

    /**
     * Creates a new Form entity.
     *
     * @Route("/new", name="form_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entityForm = new Form();
        $form = $this->createForm(FormType::class, $entityForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
	        $em->persist($entityForm);
            $em->flush();

            return $this->redirectToRoute('form_show', array('id' => $entityForm->getShort()));
        }

        return $this->render('form/new.html.twig', array(
            'form' => $entityForm,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Form entity.
     *
     * @Route("/{id}", name="form_show")
     * @Method("GET")
     */
    public function showAction(Form $form)
    {
        $deleteForm = $this->createDeleteForm($form);

        return $this->render('form/show.html.twig', array(
            'form' => $form,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Form entity.
     *
     * @Route("/{id}/edit", name="form_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Form $entityForm)
    {
        $deleteForm = $this->createDeleteForm($entityForm);
        $editForm = $this->createForm(FormType::class, $entityForm);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entityForm);
            $em->flush();

            return $this->redirectToRoute('form_edit', array('id' => $entityForm->getShort()));
        }

        return $this->render('form/edit.html.twig', array(
            'form' => $entityForm,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Form entity.
     *
     * @Route("/{id}", name="form_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Form $entiryForm)
    {
        $form = $this->createDeleteForm($entiryForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entiryForm);
            $em->flush();
        }

        return $this->redirectToRoute('form_index');
    }

    /**
     * Creates a form to delete a Form entity.
     *
     * @param Form $form The Form entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Form $form)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('form_delete', array('id' => $form->getShort())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
