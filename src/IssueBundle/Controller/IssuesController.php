<?php

namespace IssueBundle\Controller;

use IssueBundle\Entity\Issues;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Issue controller.
 *
 * @Route("issues")
 */
class IssuesController extends Controller
{
    /**
     * Lists all issue entities.
     *
     * @Route("/", name="issues_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $issues = $em->getRepository('IssueBundle:Issues')->findAll();

        return $this->render('issues/index.html.twig', array(
            'issues' => $issues,
        ));
    }

    /**
     * Creates a new issue entity.
     *
     * @Route("/new", name="issues_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $issue = new Issue();
        $form = $this->createForm('IssueBundle\Form\IssuesType', $issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($issue);
            $em->flush($issue);

            return $this->redirectToRoute('issues_show', array('id' => $issue->getId()));
        }

        return $this->render('issues/new.html.twig', array(
            'issue' => $issue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a issue entity.
     *
     * @Route("/{id}", name="issues_show")
     * @Method("GET")
     */
    public function showAction(Issues $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);

        return $this->render('issues/show.html.twig', array(
            'issue' => $issue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing issue entity.
     *
     * @Route("/{id}/edit", name="issues_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Issues $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);
        $editForm = $this->createForm('IssueBundle\Form\IssuesType', $issue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('issues_edit', array('id' => $issue->getId()));
        }

        return $this->render('issues/edit.html.twig', array(
            'issue' => $issue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a issue entity.
     *
     * @Route("/{id}", name="issues_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Issues $issue)
    {
        $form = $this->createDeleteForm($issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($issue);
            $em->flush($issue);
        }

        return $this->redirectToRoute('issues_index');
    }

    /**
     * Creates a form to delete a issue entity.
     *
     * @param Issues $issue The issue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Issues $issue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issues_delete', array('id' => $issue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
