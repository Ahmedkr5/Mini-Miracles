<?php


namespace PlanBundle\Controller;




use http\Client\Curl\User;
use PlanBundle\Entity\Emploi;
use PlanBundle\Entity\Groupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class EmploimobileController extends Controller
{

    public function readSalleAction(Request $request,$idGroup)
    {
        $em = $this->getDoctrine()->getRepository(Emploi::class);
        $list = $em->showEmp($idGroup);
        $res = array('emploi' => $list);
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($res);
        return new JsonResponse($formated);
    }
    public function choseGroupAction()
    {
        $em = $this->getDoctrine()->getRepository(Emploi::class);
        $list = $em->findgroupswithTT();
        $res = array('groups' => $list);
        $serializer= new Serializer([new ObjectNormalizer()]);
        $formated = $serializer->normalize($res);
        return new JsonResponse($formated);

    }
}