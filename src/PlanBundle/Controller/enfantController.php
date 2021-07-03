<?php

namespace PlanBundle\Controller;


use PlanBundle\Entity\Enfant;
use PlanBundle\Entity\Groupe;
use PlanBundle\Form\enfantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Enfant controller.
 *
 */
class enfantController extends Controller
{
    /**
     * Lists all enfant entities.
     *
     */
    public function indexAction()


        {
            $em = $this->getDoctrine()->getRepository(Enfant::class);
            $list = $em->findAll();
            return $this->render('@Plan/enfant/index.html.twig', array('enfants' => $list));
        }


    /**
     * Creates a new enfant entity.
     *
     */

    function updatekidAction(Request $request,$id){


        {

            $em = $this->getDoctrine()->getManager();
            $enfant = $this->getDoctrine()
                ->getRepository(Enfant::class)
                ->find($id);
            $Form = $this->createForm(enfantType::class, $enfant);
            $Form->handleRequest($request);

            if ($Form->isSubmitted()) {
                $em->flush();
                return $this->redirectToRoute('groupe_index');

            }
            return $this->render('@Plan/enfant/edit3.html.twig',
                array('f' => $Form->createView()));


        }}

    /**
     * Finds and displays a enfant entity.
     *
     */
    public function showAction(Enfant $enfant)
    {
        $deleteForm = $this->createDeleteForm($enfant);

        return $this->render('@Plan/enfant/show.html.twig', array(
            'enfant' => $enfant,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getRepository(groupe::class);
        $list = $em->deleteKids($id);
        return $this->redirectToRoute('groupe_index');
    }
   /** public function ajouterkidAction($idGroup,$id)
    {
        $em = $this->getDoctrine()->getRepository(groupe::class);
        $list = $em->AjouterKids($idGroup,$id);
        return $this->render('@Plan/groupe/edit.html.twig', array('grouplist' => $list));
    }**/

    /**
     * Displays a form to edit an existing enfant entity.
     *
     */
    public function edit2Action(Request $request, Enfant $enfant)
    {
        $deleteForm = $this->createDeleteForm($enfant);
        $editForm = $this->createForm('PlanBundle\Form\enfantType', $enfant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enfant_edit', array('id' => $enfant->getId()));
        }

        return $this->render('@Plan/enfant/edit.html.twig', array(
            'enfant' => $enfant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a enfant entity.
     *
     */


    /**
     * Creates a form to delete a enfant entity.
     *
     * @param enfant $enfant The enfant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(enfant $enfant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enfant_delete', array('id' => $enfant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
