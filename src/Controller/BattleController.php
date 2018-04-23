<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserStat;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// Controller for Profile Sub-Tabs
class BattleController extends AbstractController
{
    /**
     * @Route("/battle/findgame",name="app_my-battle-findgame")
     */
    public function battleFindgame(ObjectManager $manager)
    {
        $params = [];
        $user = $this->getUser();
        $name = $user->getUsername();
        $params["name"] = $name;

        $allStat = $manager->getRepository(UserStat::class)->findAll();


        return $this->render('battle/battle_findgame.html.twig', ["stat" => $allStat]);
    }

    /**
     * @Route("/battle/leaderboard",name="app_my-battle-leaderboard")
     */
    public function battleLeaderboard()
    {
        return $this->render('battle/battle_leaderboard.html.twig');
    }

    /**
     * @Route("/battle/deck_setup",name="app_my-battle-deck_setup")
     */
    public function battleDeckSetup()
    {
        return $this->render('battle/battle_deck_setup.html.twig');
    }

    /**
     * @Route("/battle/request",name="app_my-battle-request")
     */
    public function battleRequest()
    {
        return $this->render('battle/battle_request.html.twig');
    }

}