<?php


namespace App\Controller;


use Endroid\QrCode\Factory\QrCodeFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
//use Endroid\QrCode\QrCode;
use App\Entity\User;


class TwoFactor extends Controller
{

    /** TODO
     * Make sure that the user is logged in before using 2fa
     *
     * Configure form to add a new secret to the database for a user
     */



    /**
     * @Route("/google")
     */

    public function addSecret(QrCodeFactoryInterface  $qrCodeFactory)
    {
//        $secret=$this->container->get('scheb_two_factor.security.google_authenticator')->generateSecret();

        $user=$this->getUser();

        $qrContent=$this->get("scheb_two_factor.security.google_authenticator")->getQRContent($user);
        return $this->render('two_factor/toggle_2fa.html.twig',[/**'secret'=>$secret,*/ 'qrContent'=>$qrContent]);

    }

}