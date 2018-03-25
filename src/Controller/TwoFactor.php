<?php


namespace App\Controller;


use App\Form\TwoFactorType;
use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\Factory\QrCodeFactoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class TwoFactor extends Controller
{

    /** TODO
     * Redirect to route is 2fa is enabled, instead of rendering
     * Add feature to disable 2fa
     */

    /**
     * @Route("/enable", name="enable_2fa")
     */
    public function r(EntityManagerInterface $entityManager, Request $request, GoogleAuthenticatorInterface $twoFactor, QrCodeFactoryInterface $qrCodeFactory)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page! Please log in');
        $session = $this->get('session');

        // Get user object
        $user = $this->getUser();
        $userId = $this->getUser()->getId();

        //Get doctrine managers for setting and retrieving
        $this->getDoctrine()->getManager();
        $userSecret = $entityManager->getRepository(User::class)->find($userId);

        $form = $this->createForm(TwoFactorType::class);

        //If authenticator is enabled redired to enabled

        if (($user->isGoogleAuthenticatorEnabled()) === true) {
            return $this->render('two_factor/enabled.html.twig');
        } else {
            //If not enabled show code and validate
            $secret = $twoFactor->generateSecret();

            //Store secret in session
            if (!$request->isMethod("POST")) {
                $session->set('secret', $secret);
            }
//        dump($session->get('secret'));

            $userSecret->setGoogleAuthenticatorSecret($session->get('secret'));
            $qrContent = $twoFactor->getQRContent($user);

            //Handles only POST request
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $code = (string)$form['checkCode']->getData();

                $isValid = $twoFactor->checkCode($user, $code);

//            dump($session->get('secret'), $code, $isValid, $user);die;

                if ($isValid) {
                    $this->addFlash('success', '2FA is now enabled');
                    $entityManager->flush();
                    return $this->redirectToRoute('enable_2fa');
                } else {
                    $this->addFlash('error', 'An error occured please try again');
                    return $this->redirectToRoute('enable_2fa');
                }

            }

            return $this->render('two_factor/toggle_2fa.html.twig', ['secret' => $secret, 'qrContent' => $qrContent, 'twoFactorForm' => $form->createView()]);

        }


    }


}