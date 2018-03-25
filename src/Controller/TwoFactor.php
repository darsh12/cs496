<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\TwoFactorType;
use Doctrine\ORM\EntityManagerInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class TwoFactor extends Controller
{
    /**
     * @Route("/enable_2fa", name="enable_2fa")
     * @Security("has_role('ROLE_USER')")
     */
    public function enable_2fa(EntityManagerInterface $entityManager, Request $request, SessionInterface $session, GoogleAuthenticatorInterface $twoFactor)
    {
        // $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page! Please log in');
        // $session = $this->get('session');

        // Get user object
        $user = $this->getUser();
        $userId = $this->getUser()->getId();

        //Get doctrine managers for setting and retrieving
        $this->getDoctrine()->getManager();
        $userSecret = $entityManager->getRepository(User::class)->find($userId);

        //Get the form
        $form = $this->createForm(TwoFactorType::class);

        //If authenticator is enabled redirect to enabled

        if (($user->isGoogleAuthenticatorEnabled()) === true) {
            return $this->redirectToRoute('disable_2fa');
        } else {
            //If not enabled show code and validate
            $secret = $twoFactor->generateSecret();

            //Store secret in session
            if (!$request->isMethod("POST")) {
                $session->set('secret', $secret);
            }
//            dump($session->get('secret'));

            $userSecret->setGoogleAuthenticatorSecret($session->get('secret'));
            $qrContent = $twoFactor->getQRContent($user);

            //Handles only POST request
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $code = $form['2fa_code']->getData();

                $isValid = $twoFactor->checkCode($user, $code);

//            dump($session->get('secret'), $code, $isValid, $user);die;

                if ($isValid) {
                    $this->addFlash('success', '2FA is now enabled');
                    $entityManager->flush();
                    return $this->redirectToRoute('app_homepage');
                } else {
                    $this->addFlash('error', 'An error occured please try again');
                    return $this->redirectToRoute('enable_2fa');
                }

            }

            return $this->render('two_factor/toggle_2fa.html.twig', ['secret' => $secret, 'qrContent' => $qrContent, 'twoFactorForm' => $form->createView()]);

        }


    }

    /**
     * @Route("/disable_2fa", name="disable_2fa")
     * @Security("has_role('ROLE_USER')")
     */
    public function disable_2fa(EntityManagerInterface $entityManager, Request $request, SessionInterface $session, GoogleAuthenticatorInterface $twoFactor)
    {

        // Get user object
        $user = $this->getUser();
        $userId = $this->getUser()->getId();

        //Get doctrine managers for setting and retrieving
        $this->getDoctrine()->getManager();
        $userSecret = $entityManager->getRepository(User::class)->find($userId);

        //Get the form
        $form = $this->createForm(TwoFactorType::class);

        //If authenticator is enabled redirect to enabled

        if (($user->isGoogleAuthenticatorEnabled()) === false) {
            return $this->redirectToRoute('enable_2fa');
        } else {

            $userSecret->getGoogleAuthenticatorSecret();
            $qrContent = $twoFactor->getQRContent($user);

//            dump($userSecret);die;
            //Handles only POST request
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $code = $form['2fa_code']->getData();

                $isValid = $twoFactor->checkCode($user, $code);

//            dump($session->get('secret'), $code, $isValid, $user);die;

                if ($isValid) {
                    $userSecret->setGoogleAuthenticatorSecret(null);
                    $this->addFlash('success', '2FA is now disabled');
                    $entityManager->flush();
                    return $this->redirectToRoute('app_homepage');
                } else {
                    $this->addFlash('error', 'An error occured please try again');
                    return $this->redirectToRoute('disable_2fa');
                }

            }

            return $this->render('two_factor/disable.html.twig', ['twoFactorForm' => $form->createView()]);

        }


    }



}