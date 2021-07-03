<?php

namespace PlanBundle\Controller;

use PlanBundle\Entity\Salles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Salle controller.
 *
 */
class SallesController extends Controller
{
    /**
     * Lists all salle entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $salles = $em->getRepository('PlanBundle:Salles')->findAll();

        return $this->render('@Plan/salles/index.html.twig', array(
            'salles' => $salles,
        ));
    }
    public function orderAction()
    {
        $salles = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('PlanBundle:Salles')
            ->findBy(array(),array('capacite' => 'ASC'));

        return $this->render('@Plan/salles/index.html.twig', array(
            'salles' => $salles,
        ));
    }
    public function ordernomAction()
    {
        $salles = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('PlanBundle:Salles')
            ->findBy(array(),array('nomSalle' => 'DESC'));

        return $this->render('@Plan/salles/index.html.twig', array(
            'salles' => $salles,
        ));
    }
    /**
     * Creates a new salle entity.
     *
     */
    public function newAction(Request $request)
    {
        $salle = new Salles();
        $form = $this->createForm('PlanBundle\Form\SallesType', $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();
            $this->addFlash('success','ajoutée avec succée!');
            return $this->redirectToRoute('salles_show', array('numSalle' => $salle->getNumsalle()));
        }

        return $this->render('@Plan/salles/new.html.twig', array(
            'salle' => $salle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a salle entity.
     *
     */
    public function showAction(Salles $salle)
    {
        $deleteForm = $this->createDeleteForm($salle);

        return $this->render('@Plan/salles/show.html.twig', array(
            'salle' => $salle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing salle entity.
     *
     */
    public function editAction(Request $request, Salles $salle)
    {
        $deleteForm = $this->createDeleteForm($salle);
        $editForm = $this->createForm('PlanBundle\Form\SallesType', $salle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salles_index', array('numSalle' => $salle->getNumsalle()));
        }

        return $this->render('@Plan/salles/edit.html.twig', array(
            'salle' => $salle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a salle entity.
     *
     */
    public function deleteAction(Request $request, Salles $salle)
    {
        $form = $this->createDeleteForm($salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salle);
            $em->flush();
        }

        return $this->redirectToRoute('salles_index');
    }

    /**
     * Creates a form to delete a salle entity.
     *
     * @param Salles $salle The salle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salles $salle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salles_delete', array('numSalle' => $salle->getNumsalle())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
