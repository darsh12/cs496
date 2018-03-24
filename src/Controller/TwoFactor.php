<?php


namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\Factory\QrCodeFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use App\Entity\User;


class TwoFactor extends Controller
{

    /** TODO
     * Make sure that the user is logged in before using 2fa
     *
     * Configure form to add a new secret to the database for a user
     */


    /**
     * @Route("/enable")
     */
    public function showForm(EntityManagerInterface $entityManager, GoogleAuthenticatorInterface $twoFactor, QrCodeFactoryInterface  $qrCodeFactory)
    {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page! Please log in');

        $user=$this->getUser();
        $userId=$this->getUser()->getId();

        $this->getDoctrine()->getManager();
        $userSecret = $entityManager->getRepository(User::class)->find($userId);


        if(($user->isGoogleAuthenticatorEnabled())===true) {
            return $this->render('two_factor/enabled.html.twig');
        }
        else {
            $secret=$twoFactor->generateSecret();
            $userSecret->setGoogleAuthenticatorSecret($secret);
            $qrContent = $twoFactor->getQRContent($user);

            dump($user);

            return $this->render('two_factor/enable.html.twig',['qrContent'=>$qrContent, 'secret'=>$secret]);
        }


//        return $this->render('two_factor/enable.html.twig');

    }


//    /**
//     * @Route("/google")
//     */
//
//    public function showSecret(GoogleAuthenticatorInterface $twoFactor, QrCodeFactoryInterface  $qrCodeFactory)
//    {
//        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page! Please log in');
//
////        $secret=$twoFactor->generateSecret();
//
//        $user = $this->getUser();
//
//        dump($user);
//        $qrContent=$this->get("scheb_two_factor.security.google_authenticator")->getQRContent($user);
//        return $this->render('two_factor/toggle_2fa.html.twig',['secret'=>($user->getGoogleAuthenticatorSecret()), 'qrContent'=>$qrContent, ]);
//
//    }


}