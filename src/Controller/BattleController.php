<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// Controller for Profile Sub-Tabs
class BattleController extends AbstractController
{
    /**
     * @Route("/my_battle/findgame",name="app_my-battle-findgame")
     */
    public function battleFindgame()
    {
        return $this->render('battle/battle_findgame.html.twig');
    }

    /**
     * @Route("/my_battle/leaderboard",name="app_my-battle-leaderboard")
     */
    public function battleLeaderboard()
    {
        return $this->render('battle/battle_leaderboard.html.twig');
    }

}