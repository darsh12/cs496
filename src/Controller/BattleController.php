<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use App\Entity\Battle;
use App\Entity\BattleRequest;
use App\Entity\CharCard;
use App\Entity\User;
use App\Entity\UserCharCards;
use App\Entity\UserCharDecks;
use App\Entity\UserStat;
use App\Entity\UserUtilCards;
use App\Entity\UserUtilDecks;
use App\Entity\UtilCard;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// Controller for Profile Sub-Tabs
class BattleController extends AbstractController
{
    /**
     * @Route("/battle/card_popup",name="app_my-battle-card")
     * @Security("has_role('ROLE_USER')")
     */
    public function cardPopup(ObjectManager $manager)
    {
        $user = $this->getUser();
        $type = $_POST['type'];
        $cardID = $_POST['cardID'];

        // Get User Card Relation Object
        if($type === "util") {
            $card = $manager
                ->getRepository(UserUtilCards::class)
                ->find($cardID);

            // Check for ownership
            if($card->getUser() !== $user) {
                return $this->render(new Response("You may only view info for cards you own."));
            }

            $cardObj = $card->getUtilCard();

            $instance = new DynamicController($manager);
            $utilStatCard = $instance->getUtilStatCard($card, $manager);

            $attrModArray = $utilStatCard['attrModArray'];

            return $this->render('battle/battle_util_card.html.twig', ["utilCardObj" => $cardObj, "attribute" => $attrModArray]);

        }
        elseif($type === "char") {
            $card = $manager
                ->getRepository(UserCharCards::class)
                ->find($cardID);

            // Check for ownership
            if($card->getUser() !== $user) {
                return $this->render(new Response("You may only view info for cards you own."));
            }

            $cardObj = $card->getCharCard();

            return $this->render('battle/battle_char_card.html.twig', ["charCardObj" => $cardObj]);

        }

    }

    /**
     * @Route("/battle/leaderboard",name="app_my-battle-leaderboard")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleLeaderboard(ObjectManager $manager)
    {
        $allStat = $manager->getRepository(UserStat::class)->findAll();

        return $this->render('battle/battle_leaderboard.html.twig', ["stat" => $allStat]);
    }

    // Deck setup for attacker
    /**
     * @Route("/battle/deck_setup",name="app_my-battle-deck_setup")
     * @Security("has_role('ROLE_USER')")
     */
    public function attackerDeckSetup(ObjectManager $manager)
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
     * @Route("/battle/defender_util_setup",name="app_my-battle-def_util_setup")
     * @Security("has_role('ROLE_USER')")
     */
    public function defenderUtilDeckSetup(ObjectManager $manager)
    {
        $user = $this->getUser();

        $userUtilDecks = $manager
            ->getRepository(UserUtilDecks::class)
            ->findBy(["user" => $user]);

        return $this->render('macros', ["utilDeck" => $userUtilDecks]);
    }

    /**
     * @Route("/battle/defender_char_setup",name="app_my-battle-def_char_setup")
     * @Security("has_role('ROLE_USER')")
     */
    public function defenderCharDeckSetup(ObjectManager $manager)
    {
        $user = $this->getUser();

        $userCharDecks = $manager
            ->getRepository(UserCharDecks::class)
            ->findBy(["user" => $user]);


        return $this->render('battle/battle_deck_setup.html.twig', ["charDeck" => $userCharDecks]);
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
        // TODO: List should come from same logic used when rendering Find Game content
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



    /**
     * @Route("/battle/start",name="app_my-battle-start")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleStart(ObjectManager $manager)
    {
        $attName = $_POST['attName'];
        $user = $this->getUser();
        $requestID = $_POST['requestID'];

        $requestToAccept = $manager
            ->getRepository(BattleRequest::class)
            ->find($requestID);

        // If request is not associated with User, return error
        if($requestToAccept->getDefender() !== $user) {

            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Action",
                "notify_msg" => "You may only accept requests sent to you."
            ]);
        }

        $requestBattle = $manager
            ->getRepository(Battle::class)
            ->findOneBy(["request" => $requestToAccept]);

        // If Request has associated battle record, do not Accept, return error
        if($requestBattle) {

            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Action",
                "notify_msg" => "This battle request has already been accepted."
            ]);
        }


        //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////

        $defCharDeckID = $_POST['defCharDeckID'];
        $defUtilDeckID = $_POST['defUtilDeckID'];

        $defender = $this->getUser();

        $requestToAccept = $manager
            ->getRepository(BattleRequest::class)
            ->find($requestID);

        // Get Char Deck of Defender
        $defCharDeck = $manager
            ->getRepository(UserCharDecks::class)
            ->find($defCharDeckID);


        // If Defender's Char Deck is not their own, return error
        if($defCharDeck->getUser() !== $defender) {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Character Deck Choice",
                "notify_msg" => "You may only use decks that you own."
            ]);
        }

        // Get Util Deck of Defender
        $defUtilDeck = $manager
            ->getRepository(UserUtilDecks::class)
            ->find($defUtilDeckID);
        // If Defender's Util Deck is not their own, return error
        if($defUtilDeck->getUser() !== $defender) {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Utility Deck Choice",
                "notify_msg" => "You may only use decks that you own."
            ]);
        }

        // TODO: Logic to determine winner and build report will go here

        // Create Battle Request Record
        $battle = new Battle();
        $battle->setRequest($requestToAccept);
        // $battle->setWinner();
        // $battle->setReport();
        $battle->setDefendCharDeck($defCharDeck);
        $battle->setDefendUtilDeck($defUtilDeck);

        $manager->persist($battle);
        $manager->flush();


        // Render Results/Awards view
//        return $this->render();
        return new Response(dump($battle));
    }


    /**
     * @Route("/battle/decline",name="app_my-battle-decline")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleDecline(ObjectManager $manager)
    {

        $user = $this->getUser();

        $requestID = $_POST['requestID'];

        $requestToDelete = $manager
            ->getRepository(BattleRequest::class)
            ->find($requestID);

        // If Request chosen to decline is not associated with user, return error
        if($requestToDelete->getDefender() !== $user) {

            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Action",
                "notify_msg" => "You may only decline requests sent to you."
            ]);
        }

        $requestBattle = $manager
            ->getRepository(Battle::class)
            ->findOneBy(["request" => $requestToDelete]);

        // If Request has associated battle record, do not Decline, return error
        if($requestBattle) {

            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Action",
                "notify_msg" => "This battle request has already been accepted."
            ]);
        }

        // Delete Request Record
        $manager->remove($requestToDelete);
        $manager->flush();

        return $this->render("notification.html.twig", [
            "notify_color" => "#07ac14",
            "notify_title" => "Battle Declined",
            "notify_msg" => "Battle Request successfully declined."
        ]);
    }

}