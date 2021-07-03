<?php

namespace PlanBundle\Controller;


use PlanBundle\Entity\Emploi;
use Swift_Attachment;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * Emploi controller.
 *
 */
class EmploiController extends Controller
{
    /**
     * Lists all emploi entities.
     *
     */

    public function indexAction()
    {
        $em = $this->getDoctrine()->getRepository(Emploi::class);
        $list = $em->findgroupswithTT();

        return $this->render('@Plan/emploi/index.html.twig', array(
            'emplois' => $list,));
    }
    public function FrontindexAction()
    {
        $em = $this->getDoctrine()->getRepository(Emploi::class);
        $list = $em->findgroupswithTT();

        return $this->render('@Plan/emploi/Frontindex.html.twig', array(
            'emplois' => $list,));
    }
    public function mailAction()
    {
        $message = (new \Swift_Message())
            ->setSubject('Emploi du temps')
            ->setFrom('minimiraclestt@gmail.com')
            ->setTo('ahmed.khiari2@esprit.tn')
            ->setBody('Emploi du temps pour cette semaine');

        $attachment = Swift_Attachment::fromPath('C:\Users\Darius\Downloads\Emploi_du_temps.pdf', 'application/pdf');
        $message->attach($attachment);
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('emploi_index');
    }

    /**
     * Creates a new emploi entity.
     *
     */
    public function newAction(Request $request)
    {
        $emploi = new Emploi();
        $form = $this->createForm('PlanBundle\Form\EmploiType', $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emploi);
            $em->flush();

            return $this->redirectToRoute('emploi_new', array('idemp' => $emploi->getIdemp()));
        }

        return $this->render('@Plan/emploi/new.html.twig', array(
            'emploi' => $emploi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a emploi entity.
     *
     */
    public function showAction($idGroup)
    {
        $em = $this->getDoctrine()->getRepository(emploi::class);
        $list = $em->showEmp($idGroup);
        $emnom = $this->getDoctrine()->getRepository(Emploi::class);
        $listnom = $emnom->findgroupname($idGroup);
        $emid = $this->getDoctrine()->getRepository(Emploi::class);
        $listid = $emid->findgroupid($idGroup);
        return $this->render('@Plan/emploi/show.html.twig', array('emploilist' => $list,"grpnom"=>$listnom,"grpid"=>$listid));

    }
    public function FrontshowAction($idGroup)
    {
        $em = $this->getDoctrine()->getRepository(emploi::class);
        $list = $em->showEmp($idGroup);
        $emnom = $this->getDoctrine()->getRepository(Emploi::class);
        $listnom = $emnom->findgroupname($idGroup);
        $emid = $this->getDoctrine()->getRepository(Emploi::class);
        $listid = $emid->findgroupid($idGroup);
        return $this->render('@Plan/emploi/Frontshow.html.twig', array('emploilist' => $list,"grpnom"=>$listnom,"grpid"=>$listid));

    }



    public function pdfAction($idGroup)
    {



        $em = $this->getDoctrine()->getRepository(emploi::class);
        $list = $em->showEmp($idGroup);
        $emnom = $this->getDoctrine()->getRepository(Emploi::class);
        $listnom = $emnom->findgroupname($idGroup);
        $emid = $this->getDoctrine()->getRepository(Emploi::class);
        $listid = $emid->findgroupid($idGroup);
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('@Plan/emploi/showpdf.html.twig', array('emploilist' => $list,"grpnom"=>$listnom,"grpid"=>$listid

        ));

        $filename = 'Emploi_du_temps';

        return new Response(
            $snappy->getOutputFromHtml($html , array(
                    'orientation'   => 'Landscape',
                'lowquality' => false,
                    'encoding' => 'utf-8',
                    'images' => true,
                    'enable-javascript' => true,
                    'javascript-delay' => 5000)
            ),
            200,
            array(

                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'.pdf"'
            )

        );


    }

    /**
     * Displays a form to edit an existing emploi entity.
     *
     */
    public function editAction($idemp)
    {
        $emploi = $this->getDoctrine()->getRepository(Emploi::class)->deleteEmp($idemp);

        return $this->redirectToRoute('emploi_index');
    }







    /**
     * Creates a form to delete a emploi entity.
     *
     * @param Emploi $emploi The emploi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Emploi $emploi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('emploi_delete', array('idemp' => $emploi->getIdemp())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
