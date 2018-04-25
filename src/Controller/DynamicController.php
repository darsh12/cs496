<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\UserStat;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DynamicController extends Controller
{

    protected $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/my_profile",name="app_my-profile")
     * @Security("has_role('ROLE_USER')")
     */
    public function myProfile()
    {
        if(!$this->getUser())
            return $this->render('homepage.html.twig');


        // Create record for user's empty stats upon registration
        $this->initializeProfile();

        $user = [];
        $user['name'] = $this->getUser()->getUserName();
        return $this->render('tabs/my_profile.html.twig', ["user" => $user]);
    }


    /**
     * @Route("/inventory",name="app_inventory")
     * @Security("has_role('ROLE_USER')")
     */
    public function inventory()
    {
        return $this->render('tabs/inventory.html.twig');
    }

    /**
     * @Route("/battle",name="app_battle")
     * @Security("has_role('ROLE_USER')")
     */
    public function battle(ObjectManager $manager)
    {
        $allStat = $manager->getRepository(UserStat::class)->findAll();

        return $this->render('tabs/battle.html.twig', ["stat" => $allStat]);    }

    /**
     * @Route("/market",name="app_market")
     * @Security("has_role('ROLE_USER')")
     */
    public function market()
    {
        return $this->render('tabs/market.html.twig');
    }


    // Create empty stats record for user if it doesn't exist already
    protected function initializeProfile() {
        $user = $this->getUser();

        $userStatObj = $this->entityManager->getRepository(UserStat::class)->findBy(["user" => $user]);


        //If record doesn't exist
        if (!$userStatObj) {
            $entityManager = $this->getDoctrine()->getManager();

            //Insert the new cards

            $this->get(FirstCardsController::class)->newCards($user);

            $userStatObj = new UserStat();
            $userStatObj->setUser($user);

            $entityManager->persist($userStatObj);
            $entityManager->flush();
            $this->addFlash('success', 'You have now got cards');
        }

        // Initialize Default Avatar Reference if User has none
        $userAvatar = $user->getAvatar();

        if(!$userAvatar) {
            $defaultAvatar = $entityManager
                ->getRepository(Avatar::class)
                ->find(15); // Default Avatar's ID = 15

            $user->setAvatar($defaultAvatar);
            $entityManager->flush();
        }

        return new Response(null, 204);
    }


}