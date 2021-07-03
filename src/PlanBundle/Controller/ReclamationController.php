<?php


namespace PlanBundle\Controller;

use PlanBundle\Entity\Emploi;
use PlanBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ReclamationController extends Controller
{

    public function readRecAction($nomGroup)
    {
        $em = $this->getDoctrine()->getRepository(Reclamation::class);
        $list = $em->readrec($nomGroup);
        $res = array('Rec' => $list);
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($res);
        return new JsonResponse($formated);
    }


    public function AddrecAction($sujet,$nomGroup)
    {
        $em = $this->getDoctrine()->getManager();
        $reclam = new Reclamation();
        $reclam->setSujet($sujet);
        $reclam->setNomGroup($nomGroup);
        $em->persist($reclam);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclam);
        return new JsonResponse($formatted);
    }
}