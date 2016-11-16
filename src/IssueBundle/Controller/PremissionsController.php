<?php

namespace IssueBundle\Controller;

use IssueBundle\Entity\Premissions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Premission controller.
 *
 * @Route("premissions")
 */
class PremissionsController extends Controller
{
    /**
     * Lists all premission entities.
     *
     * @Route("/", name="premissions_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $premissions = $em->getRepository('IssueBundle:Premissions')->findAll();

        return $this->render('premissions/index.html.twig', array(
            'premissions' => $premissions,
        ));
    }

    /**
     * Creates a new premission entity.
     *
     * @Route("/new", name="premissions_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $premission = new Premission();
        $form = $this->createForm('IssueBundle\Form\PremissionsType', $premission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($premission);
            $em->flush($premission);

            return $this->redirectToRoute('premissions_show', array('id' => $premission->getId()));
        }

        return $this->render('premissions/new.html.twig', array(
            'premission' => $premission,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a premission entity.
     *
     * @Route("/{id}", name="premissions_show")
     * @Method("GET")
     */
    public function showAction(Premissions $premission)
    {
        $deleteForm = $this->createDeleteForm($premission);

        return $this->render('premissions/show.html.twig', array(
            'premission' => $premission,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing premission entity.
     *
     * @Route("/{id}/edit", name="premissions_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Premissions $premission)
    {
        $deleteForm = $this->createDeleteForm($premission);
        $editForm = $this->createForm('IssueBundle\Form\PremissionsType', $premission);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('premissions_edit', array('id' => $premission->getId()));
        }

        return $this->render('premissions/edit.html.twig', array(
            'premission' => $premission,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a premission entity.
     *
     * @Route("/{id}", name="premissions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Premissions $premission)
    {
        $form = $this->createDeleteForm($premission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($premission);
            $em->flush($premission);
        }

        return $this->redirectToRoute('premissions_index');
    }

    /**
     * Creates a form to delete a premission entity.
     *
     * @param Premissions $premission The premission entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Premissions $premission)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('premissions_delete', array('id' => $premission->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
