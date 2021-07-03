<?php

namespace PlanBundle\Controller;

use PlanBundle\Entity\Enfant;
use PlanBundle\Entity\Groupe;
use PlanBundle\Form\enfantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Groupe controller.
 *
 */
class GroupeController extends Controller
{
    /**
     * Lists all groupe entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('PlanBundle:Groupe')->findAll();

        return $this->render('@Plan/groupe/index.html.twig', array(
            'groupes' => $groupes,
        ));
    }

    /**
     * Creates a new groupe entity.
     *
     */
    public function newAction(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm('PlanBundle\Form\GroupeType', $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();

            return $this->redirectToRoute('groupe_index', array('idGroup' => $groupe->getIdgroup()));
        }

        return $this->render('@Plan/groupe/new.html.twig', array(
            'groupe' => $groupe,
            'form' => $form->createView(),
        ));
    }





    /**
     * Finds and displays a groupe entity.
     *
     */

    public function showAction($idGroup)
    {
        $em = $this->getDoctrine()->getRepository(groupe::class);
        $list = $em->findAllByGroup($idGroup);
        $emnom = $this->getDoctrine()->getRepository(groupe::class);
        $listnom = $emnom->findgroupnom($idGroup);
        $emnum = $this->getDoctrine()->getRepository(groupe::class);
        $listnum = $emnum->numberofkids($idGroup);
        return $this->render('@Plan/groupe/show.html.twig', array('grouplist' => $list,"grpnom"=>$listnom,"num"=>$listnum));
    }
    public function impAction($nomGroup)
    {
        $emnum = $this->getDoctrine()->getRepository(groupe::class);
        $group = $emnum->impByGroup($nomGroup);

        return $this->render('@Plan/groupe/imp.html.twig', array(
            'grp' => $group,
        ));
    }


    public function kidsAction()
    {
        $em = $this->getDoctrine()->getRepository(groupe::class);
        $list = $em->findAllKidsnogroup();
        return $this->render('@Plan/groupe/show2.html.twig', array('grouplist' => $list));
    }


    /**
     * Displays a form to edit an existing groupe entity.
     *
     */
    public function editAction(Request $request, Groupe $groupe)
    {
        $deleteForm = $this->createDeleteForm($groupe);
        $editForm = $this->createForm('PlanBundle\Form\GroupeType', $groupe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('groupe_index', array('idGroup' => $groupe->getIdgroup()));
        }

        return $this->render('@Plan/groupe/edit.html.twig', array(
            'groupe' => $groupe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a groupe entity.
     *
     */
    public function deleteAction(Request $request, Groupe $groupe)
    {
        $form = $this->createDeleteForm($groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush();
        }

        return $this->redirectToRoute('groupe_index');
    }

    /**
     * Creates a form to delete a groupe entity.
     *
     * @param Groupe $groupe The groupe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Groupe $groupe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groupe_delete', array('idGroup' => $groupe->getIdgroup())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
