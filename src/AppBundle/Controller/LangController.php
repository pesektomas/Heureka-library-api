<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Lang;
use AppBundle\Form\LangType;

/**
 * Lang controller.
 *
 * @Route("/lang")
 */
class LangController extends Controller
{
    /**
     * Lists all Lang entities.
     *
     * @Route("/", name="lang_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $langs = $em->getRepository('AppBundle:Lang')->findAll();

        return $this->render('lang/index.html.twig', array(
            'langs' => $langs,
        ));
    }

    /**
     * Creates a new Lang entity.
     *
     * @Route("/new", name="lang_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lang = new Lang();
        $form = $this->createForm('AppBundle\Form\LangType', $lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush();

            return $this->redirectToRoute('lang_show', array('id' => $lang->getShort()));
        }

        return $this->render('lang/new.html.twig', array(
            'lang' => $lang,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Lang entity.
     *
     * @Route("/{id}", name="lang_show")
     * @Method("GET")
     */
    public function showAction(Lang $lang)
    {
        $deleteForm = $this->createDeleteForm($lang);

        return $this->render('lang/show.html.twig', array(
            'lang' => $lang,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lang entity.
     *
     * @Route("/{id}/edit", name="lang_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lang $lang)
    {
        $deleteForm = $this->createDeleteForm($lang);
        $editForm = $this->createForm('AppBundle\Form\LangType', $lang);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush();

            return $this->redirectToRoute('lang_edit', array('id' => $lang->getShort()));
        }

        return $this->render('lang/edit.html.twig', array(
            'lang' => $lang,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lang entity.
     *
     * @Route("/{id}", name="lang_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lang $lang)
    {
        $form = $this->createDeleteForm($lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lang);
            $em->flush();
        }

        return $this->redirectToRoute('lang_index');
    }

    /**
     * Creates a form to delete a Lang entity.
     *
     * @param Lang $lang The Lang entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lang $lang)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lang_delete', array('id' => $lang->getShort())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
