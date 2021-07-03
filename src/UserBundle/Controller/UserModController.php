<?php


namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;

class UserModController extends Controller
{
    public function loginAction(Request $req){
        $user = new User;

        //encodage bcrypt : $encoded = $encoderService->encodePassword($user, $plainPassword);
        $mail = $req->get('mail');
        $pass = $req->get('pass');
        $userm = $this->getDoctrine()->getRepository(User::class)->UserMailR($mail);
        if(isset($userm) && !empty($userm)){
            $user = $this->getDoctrine()->getRepository(User::class)->find($userm['0']->getId());
            $encoderService = $this->container->get('security.password_encoder');

            $encoded = $encoderService->isPasswordValid($user, $pass);
            if ($encoded == false){
                $userm='paspaspasNon';
            }
        }
        else{
            $userm='paspaspasNon';
        }

        $ser = new Serializer([new ObjectNormalizer()]);
        $json = $ser->normalize($userm);
        return new JsonResponse($json);
    }

}