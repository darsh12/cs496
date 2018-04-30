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

            $utilStatCard = DynamicController::getUtilStatCard($card, $manager);
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
        $allStat = $manager->getRepository(UserStat::class)->orderRank();

        $rankNames = [];
        foreach ($allStat as $stat){
            $rankNames[$stat->getUsername()] = ProfileController::getRankName($stat->getUserRank());
        }

        return $this->render('battle/battle_leaderboard.html.twig', ["stat" => $allStat, "rankNames" =>$rankNames]);
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

        return $this->render('battle/battle_def_util_setup', ["utilDeck" => $userUtilDecks]);
    }

    /**
     * @Route("/battle/defender_char_setup",name="app_my-battle-def_char_setup")
     * @Security("has_role('ROLE_USER')")
     */
    public function defenderCharDeckSetup(ObjectManager $manager)
    {
        $user = $this->getUser();
        $requestID = $_POST['request'];
        $defUtilDeckID = $_POST['defUtilDeck'];

        // Request Validation ///////////////////////////////
        $requestToAccept = $manager
            ->getRepository(BattleRequest::class)
            ->find($requestID);

        // If Request chosen to decline is not associated with user, return error
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

        // If Request has associated battle record, do not accept, return error
        if($requestBattle) {

            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Action",
                "notify_msg" => "This battle request has already been accepted."
            ]);
        }

        // Util Deck validation
        $defUtilDeck = $manager
            ->getRepository(UserUtilDecks::class)
            ->find($defUtilDeckID);
        // If Defender's Util Deck is not their own, return error
        if($defUtilDeck->getUser() !== $user) {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Utility Deck Choice",
                "notify_msg" => "You may only use decks that you own."
            ]);
        }


        /// END VALIDATION /////////////////////////////////

        $attUtilDeck = $requestToAccept->getAttackerUtilDeck();
        $attCharDeck = $requestToAccept->getAttackerCharDeck();

        $utilStatCard1 = DynamicController::getUtilStatCard($attUtilDeck->getCard1(), $manager);
        $attrModArray1 = $utilStatCard1['attrModArray'];

        $utilStatCard2 = DynamicController::getUtilStatCard($attUtilDeck->getCard2(), $manager);
        $attrModArray2 = $utilStatCard2['attrModArray'];

        $utilStatCard3 = DynamicController::getUtilStatCard($attUtilDeck->getCard3(), $manager);
        $attrModArray3 = $utilStatCard3['attrModArray'];


        $attCharCards = [$attCharDeck->getCard1()->getCharCard(),
                         $attCharDeck->getCard2()->getCharCard(),
                         $attCharDeck->getCard3()->getCharCard(),
                         $attCharDeck->getCard4()->getCharCard(),
                         $attCharDeck->getCard5()->getCharCard()
        ];

        $attUtilCards = [$attUtilDeck->getCard1()->getUtilCard(),
                         $attUtilDeck->getCard2()->getUtilCard(),
                         $attUtilDeck->getCard3()->getUtilCard()
        ];
        $defUtilCards = [$defUtilDeck->getCard1()->getUtilCard(),
                         $defUtilDeck->getCard2()->getUtilCard(),
                         $defUtilDeck->getCard3()->getUtilCard()
        ];

        $diffArray = [[], [], []];


        // Build array of effect score differences to pick largest one later for use in showing effects
        for($i = 0; $i < 3; $i++) {


            // Util Effect
            $diffUtil = $defUtilCards[$i]->getEffectUtil() - $attUtilCards[$i]->getEffectUtil();
            if($diffUtil < 0)
                $diffArray[$i]['util'] = 0;
            else
                $diffArray[$i]['util'] = $diffUtil;

            // Char Effect
            $diffChar = $defUtilCards[$i]->getEffectChar() - $attUtilCards[$i]->getEffectChar();
            if($diffChar < 0)
                $diffArray[$i]['char'] = 0;
            else
                $diffArray[$i]['char'] = $diffChar;


            // Type Effect
            $diffType = $defUtilCards[$i]->getEffectType() - $attUtilCards[$i]->getEffectType();
            if($diffType < 0)
                $diffArray[$i]['type'] = 0;
            else
                $diffArray[$i]['type'] = $diffType;


            // Order Effect
            $diffOrder = $defUtilCards[$i]->getEffectOrder() - $attUtilCards[$i]->getEffectOrder();
            if($diffOrder < 0)
                $diffArray[$i]['order'] = 0;
            else
                $diffArray[$i]['order'] = $diffOrder;


            // Class Effect
            $diffClass = $defUtilCards[$i]->getEffectClass() - $attUtilCards[$i]->getEffectClass();
            if($diffClass < 0)
                $diffArray[$i]['class'] = 0;
            else
                $diffArray[$i]['class'] = $diffClass;

        }

        $diffUtil = max($diffArray[0]['util'], $diffArray[1]['util'], $diffArray[2]['util']);
        $diffChar = max($diffArray[0]['char'], $diffArray[1]['char'], $diffArray[2]['char']);
        $diffType = max($diffArray[0]['type'], $diffArray[1]['type'], $diffArray[2]['type']);
        $diffOrder = max($diffArray[0]['order'], $diffArray[1]['order'], $diffArray[2]['order']);
        $diffClass = max($diffArray[0]['class'], $diffArray[1]['class'], $diffArray[2]['class']);

        $userCharDecks = $manager
            ->getRepository(UserCharDecks::class)
            ->findBy(["user" => $user]);

        return $this->render('battle/battle_def_char_setup.html.twig', [
            "charDeck" => $userCharDecks,
            "utilDeck" => $attUtilDeck,
            "attribute1" => $attrModArray1,
            "attribute2" => $attrModArray2,
            "attribute3" => $attrModArray3,
            "attCharDeck" => $attCharDeck,
            "diff_util" => $diffUtil,
            "diff_char" => $diffChar,
            "diff_type" => $diffType,
            "diff_order" => $diffOrder,
            "diff_class" => $diffClass
        ]);
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

        // VALIDATION OF REQUEST /////////////////////////////

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
        $attacker = $requestToAccept->getAttacker();

        // VALIDATION OF DECKS /////////////////////////////
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
        // END VALIDATION /////////////////////////////
        ///////////////////////////////////////////////

        // TODO: Logic to determine winner and build report will go here

        // Calculate average of Utility Card Attribute Modifiers

        $attUtilDeck = $requestToAccept->getAttackerUtilDeck();
        $attCharDeck = $requestToAccept->getAttackerCharDeck();

        // Get Attacker's Attribute Mods
        $jsonAttributeString =  $attUtilDeck->getCard1()->getUtilCard()->getAttributeModifier();
        $attAttr1 = json_decode($jsonAttributeString);
        $jsonAttributeString =  $attUtilDeck->getCard2()->getUtilCard()->getAttributeModifier();
        $attAttr2 = json_decode($jsonAttributeString);
        $jsonAttributeString =  $attUtilDeck->getCard3()->getUtilCard()->getAttributeModifier();
        $attAttr3 = json_decode($jsonAttributeString);

        $uses =$attUtilDeck->getCard1()->getCardUses();
        $attUtilDeck->getCard1()->setCardUses($uses +1);
        $manager->flush();
        $uses =$attUtilDeck->getCard2()->getCardUses();
        $attUtilDeck->getCard2()->setCardUses($uses +1);
        $manager->flush();
        $uses =$attUtilDeck->getCard3()->getCardUses();
        $attUtilDeck->getCard3()->setCardUses($uses +1);
        $manager->flush();


        // Get Defender's Attribute Mods
        $jsonAttributeString =  $defUtilDeck->getCard1()->getUtilCard()->getAttributeModifier();
        $defAttr1 = json_decode($jsonAttributeString);
        $jsonAttributeString =  $defUtilDeck->getCard2()->getUtilCard()->getAttributeModifier();
        $defAttr2 = json_decode($jsonAttributeString);
        $jsonAttributeString =  $defUtilDeck->getCard3()->getUtilCard()->getAttributeModifier();
        $defAttr3 = json_decode($jsonAttributeString);

        $uses =$defUtilDeck->getCard1()->getCardUses();
        $defUtilDeck->getCard1()->setCardUses($uses +1);
        $manager->flush();
        $uses =$defUtilDeck->getCard2()->getCardUses();
        $defUtilDeck->getCard2()->setCardUses($uses +1);
        $manager->flush();
        $uses =$defUtilDeck->getCard3()->getCardUses();
        $defUtilDeck->getCard3()->setCardUses($uses +1);
        $manager->flush();

        $attAttrMod = [];
        $attAttrMod["hp"] = ($attAttr1->hp + $attAttr2->hp + $attAttr3->hp)/3;
        $attAttrMod["att"] = ($attAttr1->attack + $attAttr2->attack + $attAttr3->attack)/3;
        $attAttrMod["def"] = ($attAttr1->defense + $attAttr2->defense + $attAttr3->defense)/3;
        $attAttrMod["agi"] = ($attAttr1->agility + $attAttr2->agility + $attAttr3->agility)/3;
        $attAttrMod["lck"] = ($attAttr1->luck + $attAttr2->luck + $attAttr3->luck)/3;
        $attAttrMod["spd"] = ($attAttr1->speed + $attAttr2->speed + $attAttr3->speed)/3;

        $defAttrMod = [];
        $defAttrMod["hp"] = ($defAttr1->hp + $defAttr2->hp + $defAttr3->hp)/3;;
        $defAttrMod["att"] = ($defAttr1->attack + $defAttr2->attack + $defAttr3->attack)/3;;
        $defAttrMod["def"] = ($defAttr1->defense + $defAttr2->defense + $defAttr3->defense)/3;;
        $defAttrMod["agi"] = ($defAttr1->agility + $defAttr2->agility + $defAttr3->agility)/3;;
        $defAttrMod["lck"] = ($defAttr1->luck + $defAttr2->luck + $defAttr3->luck)/3;;
        $defAttrMod["spd"] = ($defAttr1->speed + $defAttr2->speed + $defAttr3->speed)/3;;

        // Battle Report
        $battleReport = "";
        $defIndex = 0;
        $attIndex = 0;

        $attChars = [
            $attCharDeck->getCard1()->getCharCard(),
            $attCharDeck->getCard2()->getCharCard(),
            $attCharDeck->getCard3()->getCharCard(),
            $attCharDeck->getCard4()->getCharCard(),
            $attCharDeck->getCard5()->getCharCard()
        ];

        $uses =$attCharDeck->getCard1()->getCardUses();
        $attCharDeck->getCard1()->setCardUses($uses +1);
        $manager->flush();
        $uses =$attCharDeck->getCard2()->getCardUses();
        $attCharDeck->getCard2()->setCardUses($uses +1);
        $manager->flush();
        $uses =$attCharDeck->getCard3()->getCardUses();
        $attCharDeck->getCard3()->setCardUses($uses +1);
        $manager->flush();
        $uses =$attCharDeck->getCard4()->getCardUses();
        $attCharDeck->getCard4()->setCardUses($uses +1);
        $manager->flush();
        $uses =$attCharDeck->getCard5()->getCardUses();
        $attCharDeck->getCard5()->setCardUses($uses +1);
        $manager->flush();


        $defChars = [
            $defCharDeck->getCard1()->getCharCard(),
            $defCharDeck->getCard2()->getCharCard(),
            $defCharDeck->getCard3()->getCharCard(),
            $defCharDeck->getCard4()->getCharCard(),
            $defCharDeck->getCard5()->getCharCard()
        ];


        $uses =$defCharDeck->getCard1()->getCardUses();
        $defCharDeck->getCard1()->setCardUses($uses +1);
        $manager->flush();
        $uses =$defCharDeck->getCard2()->getCardUses();
        $defCharDeck->getCard2()->setCardUses($uses +1);
        $manager->flush();
        $uses =$defCharDeck->getCard3()->getCardUses();
        $defCharDeck->getCard3()->setCardUses($uses +1);
        $manager->flush();
        $uses =$defCharDeck->getCard4()->getCardUses();
        $defCharDeck->getCard4()->setCardUses($uses +1);
        $manager->flush();
        $uses =$defCharDeck->getCard5()->getCardUses();
        $defCharDeck->getCard5()->setCardUses($uses +1);
        $manager->flush();

        // Battle Loop
        // Iterate through card arrays to simulate battle, represent card order with indices
        // While there is still an attacker/defender card alive
        $firstHP = 0;
        $secondHP = 0;
        while($defIndex < 5 and $attIndex < 5) {
            if($defIndex >= 5 || $attIndex >= 5)
                return new Response("$defIndex , $attIndex");
            // Apply SPEED attribute modifier
            $defSpeed = $defChars[$defIndex]->getSpeed() + (($defAttrMod["spd"]/100) * $defChars[$defIndex]->getSpeed());
            $attSpeed = $attChars[$attIndex]->getSpeed() + (($attAttrMod["spd"]/100) * $attChars[$attIndex]->getSpeed());

            // Determine Character who will attack first using SPEED attribute
            if($defSpeed >= $attSpeed) {

                $prob = rand(0,99);
                if($prob < ($defSpeed * 10)) {
                    $firstChar = $defChars[$defIndex];
                    $secondChar = $attChars[$attIndex];

                    $firstAttribute = $defAttrMod;
                    $secondAttribute = $attAttrMod;

                    $firstRole = "defender";
                    $secondRole = "attacker";
                } else {
                    $firstChar = $attChars[$attIndex];
                    $secondChar = $defChars[$defIndex];

                    $firstAttribute = $attAttrMod;
                    $secondAttribute = $defAttrMod;

                    $firstRole = "attacker";
                    $secondRole = "defender";
                }
            } else {

                $prob = rand(0,99);
                if($prob < ($attSpeed * 10)) {
                    $firstChar = $attChars[$attIndex];
                    $secondChar = $defChars[$defIndex];

                    $firstAttribute = $attAttrMod;
                    $secondAttribute = $defAttrMod;

                    $firstRole = "attacker";
                    $secondRole = "defender";
                } else {
                    $firstChar = $defChars[$defIndex];
                    $secondChar = $attChars[$attIndex];

                    $firstAttribute = $defAttrMod;
                    $secondAttribute = $attAttrMod;

                    $firstRole = "defender";
                    $secondRole = "attacker";
                }
            }

            /////////////////////////////////////////////////////
            // Get ATTACK attribute and apply type/attribute mods
            /////////////////////////////////////////////////////
            $firstAttack = $firstChar->getAttack();
            $secondAttack = $secondChar->getAttack();

            //// Get Type Modifier for this Character pairing
            $firstTypeMod = $this->getTypeModifier($firstChar->getCharType(), $secondChar->getCharType());
            $secondTypeMod = -1 * $firstTypeMod;

            //// Get Attack Attribute Modifier for each card
            $firstAttMod = $firstAttack * ($firstAttribute["att"]/100);
            $secondAttMod = $secondAttack * ($secondAttribute["att"]/100);

            //// Apply to attacker/defender ATTACK attribute
            $firstAttack += $firstTypeMod + $firstAttMod;
            $secondAttack += $secondTypeMod + $secondAttMod;

            /////////////////////////////////////////////////////
            /////////////////////////////////////////////////////


            /////////////////////////////////////////////////////
            //// Apply other attribute mods
            /////////////////////////////////////////////////////
            //// HP attribute mod
            $dont = true;
            if($firstHP <= 0) {
                $firstHP = $firstChar->getHitPoints() + (($firstAttribute["hp"] / 100) * $firstChar->getHitPoints());
                $baseFirstHP = $firstHP;
                $battleReport .= $firstChar->getCharName()." takes the first turn against ".$secondChar->getCharName()."<\n";
                $dont = false;
            }
            if($secondHP <= 0) {
                $secondHP = $secondChar->getHitPoints() + (($secondAttribute["hp"] / 100) * $secondChar->getHitPoints());
                $baseSecondHP = $secondHP;
                if($dont)
                    $battleReport .= $firstChar->getCharName()." takes the first turn against ".$secondChar->getCharName()."\n";
            }
            //// DEFENSE attribute mod
            $firstDef = $firstChar->getDefense() + (($firstAttribute["def"]/100) * $firstChar->getDefense());
            $secondDef = $secondChar->getDefense() + (($secondAttribute["def"]/100) * $secondChar->getDefense());
            //// AGILITY attribute mod
            $firstAgi = $firstChar->getAgility() + (($firstAttribute["agi"]/100) * $firstChar->getAgility());
            $secondAgi = $secondChar->getAgility() + (($secondAttribute["agi"]/100) * $secondChar->getAgility());
            //// LUCK attribute mod
            $firstLck = $firstChar->getLuck() + (($firstAttribute["lck"]/100) * $firstChar->getLuck());
            $secondLck = $secondChar->getLuck() + (($secondAttribute["lck"]/100) * $secondChar->getLuck());
            /////////////////////////////////////////////////////
            /////////////////////////////////////////////////////



            // Fight Loop
            while($firstHP > 0 and $secondHP > 0) {

                /////////////////////////////////////////////////////
                // First Character's Turn
                /////////////////////////////////////////////////////
                $baseDamage =  $baseSecondHP * ($firstAttack/100);
                $defendDamage = $baseDamage * ($secondDef/100);

                // Check for Critical chance (extra damage applied)
                $critMod = 0;
                $prob = rand(0,99);
                if($prob < $firstLck) {
                    $critMod = $defendDamage * ($firstLck/100);
                }

                $finalDamage = $defendDamage + $critMod;

                // Check for Dodge chance (no damage applied)
                $prob = rand(0,99);
                if($prob < $secondAgi) {
                    if($critMod > 0)
                        $battleReport .= $secondChar->getCharName()." dodged ".$firstChar->getCharName()."'s critical attack of $finalDamage damage! \n";
                    else
                        $battleReport .= $secondChar->getCharName()." dodged ".$firstChar->getCharName()."'s attack of $finalDamage damage! \n";
                    $finalDamage = 0;
                }

                // Attack Second Card
                $secondHP -= $finalDamage;

                if($finalDamage > 0) {
                    $battleReport .= $firstChar->getCharName() . " hit " . $secondChar->getCharName() . " for $finalDamage damage! \n";
                    $battleReport .= "____(HP Remaining: $secondHP)\n";
                }

                if($secondHP <= 0 and $secondRole === "attacker") {
                    $attIndex++;
                    break;
                } elseif($secondHP <= 0 and $secondRole === "defender") {
                    $defIndex++;
                    break;
                }


                /////////////////////////////////////////////////////
                /////////////////////////////////////////////////////

                /////////////////////////////////////////////////////
                // Second Character's Turn
                /////////////////////////////////////////////////////
                $baseDamage =  $baseFirstHP * ($secondAttack/100);
                $defendDamage = $baseDamage * ($firstDef/100);

                // Check for Critical chance (extra damage applied)
                $critMod = 0;
                $prob = rand(0,99);
                if($prob < $secondLck) {
                    $critMod = $defendDamage * ($secondLck/100);
                }

                $finalDamage = $defendDamage + $critMod;

                // Check for Dodge chance (no damage applied)
                $prob = rand(0,99);
                if($prob < $firstAgi) {
                    if($critMod > 0)
                        $battleReport .= $firstChar->getCharName()." dodged ".$secondChar->getCharName()."'s critical attack of $finalDamage damage! \n";
                    else
                        $battleReport .= $firstChar->getCharName()." dodged ".$secondChar->getCharName()."'s attack of $finalDamage damage! \n";
                    $finalDamage = 0;
                }

                // Attack First Card
                $firstHP -= $finalDamage;


                if($finalDamage > 0) {
                    $battleReport .= $secondChar->getCharName() . " hit " . $firstChar->getCharName() . " for $finalDamage damage! \n";
                    $battleReport .= "____(HP Remaining: $firstHP)\n";
                }

                if($firstHP <= 0 and $firstRole === "defender") {
                    $defIndex++;
                    break;
                } elseif($firstHP <= 0 and $firstRole === "attacker") {
                    $attIndex++;
                    break;
                }
                /////////////////////////////////////////////////////
                /////////////////////////////////////////////////////
            }

            // Increment index of defeated player's card to give next ordered char a turn
            if($firstHP <= 0) {
                $battleReport .= "____".$firstChar->getCharName()." was defeated by ".$secondChar->getCharName()."! \n\n";
            }
            elseif($secondHP <= 0) {
                $battleReport .= "____".$secondChar->getCharName()." was defeated by ".$firstChar->getCharName()."! \n\n";
            }

        }

        if($defIndex >= 5)
            $winner = $defender;
        elseif($attIndex >= 5)
            $winner = $attacker;

        $userStat = $manager->getRepository(UserStat::class)->findOneBy(["user" => $user]);

        // Win, Loss count
        if($winner === $attacker) {
            $resultText = "You Lose!";
            $win = false;
            $lost = $userStat->getMatchesLost();
            $userStat->setMatchesLost($lost + 1);
            $manager->flush();
        }
        else {
            $resultText = "You win!";
            $win = true;
            $won = $userStat->getMatchesWon();
            $userStat->setMatchesWon($won + 1);
            $manager->flush();
        }

        // W/L ratio
        if($userStat->getMatchesLost() === 0) {
            $winLoss = $userStat->getMatchesWon();
            $userStat->setWinLossRatio($winLoss);
            $manager->flush();
        } else {
            $winLoss = $userStat->getMatchesWon() / $userStat->getMatchesLost();
            $userStat->setWinLossRatio($winLoss);
            $manager->flush();
        }


        $battleReport .= $winner->getUsername()." wins the battle!";

        // Create Battle Request Record
        $battle = new Battle();
        $battle->setRequest($requestToAccept);
        $battle->setWinner($winner);
        $battle->setReport($battleReport);
        $battle->setDefendCharDeck($defCharDeck);
        $battle->setDefendUtilDeck($defUtilDeck);

        $manager->persist($battle);
        $manager->flush();


        // Init best/worst battles
        if(!$userStat->getBestWinBattle()) {
            $userStat->setBestWinBattle($battle);
            $manager->flush();
        }
        if(!$userStat->getWorstLostBattle()) {
            $userStat->setWorstLostBattle($battle);
            $manager->flush();
        }

        $timesDef = $userStat->getTimesDefended() + 1;
        $userStat->setTimesDefended($timesDef);
        $manager->flush();

        $earnedXP = $this->getEarnedXP($userStat->getUserRank(), "attacker", $win);
        $userStat->setExperience($earnedXP + $userStat->getExperience());
        $manager->flush();

        $earnedCoins = $this->getEarnedCoins($userStat->getUserRank(), "attacker", $win);
        $user->setCoins($earnedCoins + $user->getCoins());
        $manager->flush();

        // Check for level up
        $level = $userStat->getUserLevel() + 1;
        $const = 0.6;
        $xpNeeded = (pow($level, $const) * 100 );
        $levelUpText = "";
        if($userStat->getExperience() >= $xpNeeded) {
            $userStat->setUserLevel($level+1);
            $manager->flush();
            $levelUpText = "You gained a level! You are now level ".$userStat->getUserLevel();
        }


        // Stretch
        // TODO: set fav/worst cards if initial battle
        // TODO: check for updates to fav/worst battles/cards

        return $this->render("battle/battle_results.html.twig", [
            "result_text" => $resultText,
            "battle_report" => $battleReport,
            "coins" => $earnedCoins,
            "experience" => $earnedXP,
            "level" => $levelUpText
        ]);
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

    /**
     * @Route("/battle/results",name="app_my-battle-results")
     * @Security("has_role('ROLE_USER')")
     */
    public function battleResults(ObjectManager $manager)
    {
        $user = $this->getUser();
        $requestID = $_POST['requestID'];

        // VALIDATION OF REQUEST /////////////////////////////

        $requestToAccept = $manager
            ->getRepository(BattleRequest::class)
            ->find($requestID);

        // If request is not associated with User, return error
        if($requestToAccept->getAttacker() !== $user) {

            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid Action",
                "notify_msg" => "You may view results of your battles."
            ]);
        }

        $requestBattle = $manager
            ->getRepository(Battle::class)
            ->findOneBy(["request" => $requestToAccept]);

        if(!$requestBattle) {
            $this->addFlash("fail", "This battle has not been accepted yet.");
            return $this->redirectToRoute("app_battle");
        }

        //////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////

        $userStat = $manager->getRepository(UserStat::class)->findOneBy(["user" => $user]);

        // Win, Loss count
        if($requestBattle->getWinner() !== $user) {
            $resultText = "You Lose!";
            $win = false;
            $lost = $userStat->getMatchesLost();
            $userStat->setMatchesLost($lost + 1);
            $manager->flush();
        }
        else {
            $resultText = "You win!";
            $win = true;
            $won = $userStat->getMatchesWon();
            $userStat->setMatchesWon($won + 1);
            $manager->flush();
        }

        // W/L ratio
        if($userStat->getMatchesLost() === 0) {
            $winLoss = $userStat->getMatchesWon();
            $userStat->setWinLossRatio($winLoss);
            $manager->flush();
        } else {
            $winLoss = $userStat->getMatchesWon() / $userStat->getMatchesLost();
            $userStat->setWinLossRatio($winLoss);
            $manager->flush();
        }

        // Init best/worst battles
        if(!$userStat->getBestWinBattle()) {
            $userStat->setBestWinBattle($requestBattle);
            $manager->flush();
        }
        if(!$userStat->getWorstLostBattle()) {
            $userStat->setWorstLostBattle($requestBattle);
            $manager->flush();
        }

        $timesAtt = $userStat->getTimesAttacked() + 1;
        $userStat->setTimesAttacked($timesAtt);
        $manager->flush();

        $earnedXP = $this->getEarnedXP($userStat->getUserRank(), "attacker", $win);
        $userStat->setExperience($earnedXP + $userStat->getExperience());
        $manager->flush();

        $earnedCoins = $this->getEarnedCoins($userStat->getUserRank(), "attacker", $win);
        $user->setCoins($earnedCoins + $user->getCoins());
        $manager->flush();

        // Check for level up
        $level = $userStat->getUserLevel() + 1;
        $const = 0.6;
        $xpNeeded = (pow($level, $const) * 100 );
        $levelUpText = "";
        if($userStat->getExperience() >= $xpNeeded) {
            $userStat->setUserLevel($level+1);
            $manager->flush();
            $levelUpText = "You gained a level! You are now level ".$userStat->getUserLevel();
        }

        $requestBattle->setViewed(1);
        $manager->flush();


        return $this->render("battle/battle_results.html.twig", [
            "result_text" => $resultText,
            "battle_report" => $requestBattle->getReport(),
            "coins" => $earnedCoins,
            "experience" => $earnedXP,
            "level" => $levelUpText
        ]);

    }

    protected function getTypeModifier($currType, $opponentType) {

        if($currType === "Action") {
            if($opponentType === "Drama")
                return 5;
            else
                return (-5);
        }
        elseif($currType === "Drama") {
            if($opponentType === "Comedy")
                return 5;
            else
                return (-5);
        }
        elseif($currType === "Comedy") {
            if($opponentType === "Action")
                return 5;
            else
                return (-5);
        }
    }

    // Rank, Role, Win, Performance XP Modifiers
    protected function getEarnedXP($rank, $role, $win) {

        $xp = 0;
        // Role
        if($role === "attacker")
            $xp += 100;
        else
            $xp += 50;

        if($win === true)
            $xp += 75;
        else
            $xp += 25;


        // Rank
        if($rank >= 1 && $rank < 6)
            $xp += 30;
        elseif($rank >= 6 && $rank < 11)
            $xp += 60;
        elseif($rank >= 11 && $rank < 16)
            $xp += 90;
        elseif($rank >= 16 && $rank < 21)
            $xp += 120;
        elseif($rank >= 21 && $rank < 26)
            $xp += 150;
        elseif($rank >= 26 && $rank < 31)
            $xp += 180;

        return $xp;
    }

    // Rank, Role, Win, Performance XP Modifiers
    protected function getEarnedCoins($rank, $role, $win) {
        $coins = 0;
        // Role
        if($role === "attacker")
            $coins += 5;
        else
            $coins += 2;

        if($win === true)
            $coins += 10;
        else
            $coins += 5;


        // Rank
        if($rank >= 1 && $rank < 6)
            $coins += 3;
        elseif($rank >= 6 && $rank < 11)
            $coins += 6;
        elseif($rank >= 11 && $rank < 16)
            $coins += 9;
        elseif($rank >= 16 && $rank < 21)
            $coins += 12;
        elseif($rank >= 21 && $rank < 26)
            $coins += 15;
        elseif($rank >= 26 && $rank < 31)
            $coins += 18;

        return $coins;
    }

}