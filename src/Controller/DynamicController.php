<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;


use App\Entity\UserStat;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     */
    public function inventory()
    {
        return $this->render('tabs/inventory.html.twig');
    }

    /**
     * @Route("/battle",name="app_battle")
     */
    public function battle()
    {
        return $this->render('tabs/battle.html.twig');
    }

    /**
     * @Route("/market",name="app_market")
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

        return new Response(null, 204);
    }


}