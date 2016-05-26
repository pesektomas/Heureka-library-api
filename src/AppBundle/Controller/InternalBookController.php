<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\InternalBook;
use AppBundle\Form\InternalBookType;

/**
 * InternalBook controller.
 *
 * @Route("/internalbook")
 */
class InternalBookController extends Controller
{
    /**
     * Lists all InternalBook entities.
     *
     * @Route("/", name="internalbook_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $internalBooks = $em->getRepository('AppBundle:InternalBook')->findAll();

        return $this->render('internalbook/index.html.twig', array(
            'internalBooks' => $internalBooks,
        ));
    }

    /**
     * Creates a new InternalBook entity.
     *
     * @Route("/new", name="internalbook_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $internalBook = new InternalBook();
        $form = $this->createForm('AppBundle\Form\InternalBookType', $internalBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $internalBook->setBook(self::getBook($internalBook));

            $em->persist($internalBook);
            $em->flush();

            $qb = $em->createQueryBuilder();
            $users = $qb->select(['u.googleToken'])
                ->from(User::class, 'u')
                ->where('u.googleToken IS NOT NULL')
                ->getQuery()
                ->getResult();

            $tokens = [];

            foreach ($users as $user) {
                $tokens[] = $user['googleToken'];
            }

            $this->get('android.push')
                ->push($this->getParameter('android'), $tokens, 'Nové heurékoviny', 'Byly vloženy nové heurekoviny - ' . $internalBook->getDate()->format('m/Y'));

            return $this->redirectToRoute('internalbook_show', array('id' => $internalBook->getId()));
        }

        return $this->render('internalbook/new.html.twig', array(
            'internalBook' => $internalBook,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InternalBook entity.
     *
     * @Route("/{id}", name="internalbook_show")
     * @Method("GET")
     */
    public function showAction(InternalBook $internalBook)
    {
        $deleteForm = $this->createDeleteForm($internalBook);

        return $this->render('internalbook/show.html.twig', array(
            'internalBook' => $internalBook,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InternalBook entity.
     *
     * @Route("/{id}/edit", name="internalbook_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InternalBook $internalBook)
    {
        // TODO !!!
        $internalBook->setBook(null);

        $deleteForm = $this->createDeleteForm($internalBook);
        $editForm = $this->createForm('AppBundle\Form\InternalBookType', $internalBook);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $internalBook->setBook(self::getBook($internalBook));
            $em->persist($internalBook);
            $em->flush();

            return $this->redirectToRoute('internalbook_edit', array('id' => $internalBook->getId()));
        }

        return $this->render('internalbook/edit.html.twig', array(
            'internalBook' => $internalBook,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InternalBook entity.
     *
     * @Route("/{id}", name="internalbook_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InternalBook $internalBook)
    {
        $form = $this->createDeleteForm($internalBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($internalBook);
            $em->flush();
        }

        return $this->redirectToRoute('internalbook_index');
    }

    /**
     * Creates a form to delete a InternalBook entity.
     *
     * @param InternalBook $internalBook The InternalBook entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InternalBook $internalBook)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('internalbook_delete', array('id' => $internalBook->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function getBook(InternalBook $internalBook) {
        if ($internalBook->getBook() != null) {
            $handle = fopen($internalBook->getBook(), 'r');
            $bytes = fread($handle, filesize($internalBook->getBook()));
            return $bytes;
        }
        return null;
    }
}
