<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use App\Entity\BattleRequest;
use App\Entity\User;
use App\Entity\UserCharDecks;
use App\Entity\UserStat;
use App\Entity\UserUtilDecks;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// Controller for Profile Sub-Tabs
class BattleController extends AbstractController
{
    /**
     * @Route("/battle/findgame",name="app_my-battle-findgame")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleFindgame(ObjectManager $manager)
    {
        $allStat = $manager->getRepository(UserStat::class)->findAll();

        return $this->render('battle/battle_findgame.html.twig', ["stat" => $allStat]);
    }

    /**
     * @Route("/battle/leaderboard",name="app_my-battle-leaderboard")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleLeaderboard()
    {
        return $this->render('battle/battle_leaderboard.html.twig');
    }

    /**
     * @Route("/battle/deck_setup",name="app_my-battle-deck_setup")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleDeckSetup(ObjectManager $manager)
    {
        $user = $this->getUser();

        $userCharDecks = $manager
            ->getRepository(UserCharDecks::class)
            ->findBy(["user" => $user]);

        $userUtilDecks = $manager
            ->getRepository(UserUtilDecks::class)
            ->findBy(["user" => $user]);

        return $this->render('battle/battle_deck_setup.html.twig', ["charDeck" => $userCharDecks, "utilDeck" => $userUtilDecks]);
    }

    /**
     * @Route("/battle/request",name="app_my-battle-request")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleRequest(ObjectManager $manager)
    {
        $defName = $_POST['defName'];
        $attCharDeckID = $_POST['attCharDeckID'];
        $attUtilDeckID = $_POST['attUtilDeckID'];

        $attacker = $this->getUser();

        // TODO: Validate that defender is part of player list shown when choosing an opponent
        $defender = $manager
            ->getRepository(User::class)
            ->findOneBy(["username" => $defName]);


        // Get Char Deck of Attacker
        $attCharDeck = $manager
            ->getRepository(UserCharDecks::class)
            ->find($attCharDeckID);
        // If Attacker's Char Deck is not their own, return error
        if($attCharDeck->getUser() !== $attacker) {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Character Deck Choice",
                "notify_msg" => "You may only use decks that you own."
            ]);
        }

        // Get  Util Deck of Attacker
        $attUtilDeck = $manager
            ->getRepository(UserUtilDecks::class)
            ->find($attUtilDeckID);
        // If Attacker's Util Deck is not their own, return error
        if($attUtilDeck->getUser() !== $attacker) {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Utility Deck Choice",
                "notify_msg" => "You may only use decks that you own."
            ]);
        }

        // Create Battle Request Record
        $battleRequest = new BattleRequest();
        $battleRequest->setAttacker($attacker);
        $battleRequest->setDefender($defender);
        $battleRequest->setAttackerCharDeck($attCharDeck);
        $battleRequest->setAttackerUtilDeck($attUtilDeck);

        $manager->persist($battleRequest);
        $manager->flush();

        return $this->render("notification.html.twig", [
            "notify_color" => "#07ac14",
            "notify_title" => "Request Sent",
            "notify_msg" => "Request successfully sent to $defName"
        ]);
    }

}