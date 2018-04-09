<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;


use App\Entity\UserStat;
use Doctrine\DBAL\Types\TimeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DynamicController extends AbstractController
{

    /**
     * @Route("/my_profile",name="app_my-profile")
     */
    public function myProfile()
    {
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
        $userID = $user->getId();

        $userStatObj = $this->getDoctrine()
            ->getRepository(UserStat::class)
            ->find($userID);

        // If Stats record exists, return
        if ($userStatObj) {
            return;
        }
        // Initialize User's stats
        else {
            $entityManager = $this->getDoctrine()->getManager();

            $userStatObj = new UserStat();
            $userStatObj->setUserId($user);
            $userStatObj->setUserRank(0);
            $userStatObj->setUserLevel(0);
            $userStatObj->setPlayTime(new \DateTime("00:00:00"));
            $userStatObj->setMatchesWon(0);
            $userStatObj->setMatchesLost(0);
            $userStatObj->setWinLossRatio(0);
            $userStatObj->setTimesAttacked(0);
            $userStatObj->setTimesDefended(0);

            $entityManager->persist($userStatObj);
            $entityManager->flush();
        }
    }


}