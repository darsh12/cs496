<?php

namespace App\Controller;

use App\Entity\CharCard;
use App\Entity\User;
use App\Entity\UserCharCards;
use App\Entity\UserUtilCards;
use App\Entity\UtilCard;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FirstCardsController extends Controller
{

    protected $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    /**
     * Used to insert a card to UserCharCards
     * @param User $user
     * @param CharCard $charCard
     */
    public function insertCharCard(User $user, CharCard $charCard)
    {

        $userCharCardsRepository = $this->entityManager->getRepository('App:UserCharCards')->findOneBy([
            'user' => $user, 'char_card' => $charCard]);

        /**
         * If card does not exist for user
         */
        if (!$userCharCardsRepository) {
            $userCharCards = new UserCharCards();
            $userCharCards->setUser($user);
            $userCharCards->setCharCard($charCard);
            $userCharCards->setCardCount(($userCharCards->getCardCount()) + 1);

            $this->entityManager->persist($userCharCards);
        } else {
            $userCharCardsRepository->setCardCount(($userCharCardsRepository->getCardCount()) + 1);
        }

        $this->entityManager->flush();

        return new Response(null, 204);

    }


    /**
     * Used to insert a card to UserUtilCards
     * @param User $user
     * @param UtilCard $utilCard
     */
    public function insertUtilCard(User $user, UtilCard $utilCard)
    {
        $userUtilCardsRepository = $this->entityManager->getRepository('App:UserUtilCards')->findOneBy([
            'user' => $user, 'util_card' => $utilCard
        ]);

        /**
         * If card does not exist for user
         */
        if (!$userUtilCardsRepository) {
            $userUtilCards = new UserUtilCards();
            $userUtilCards->setUser($user);
            $userUtilCards->setUtilCard($utilCard);
            $userUtilCards->setCardCount(($userUtilCards->getCardCount()) + 1);

            $this->entityManager->persist($userUtilCards);
        } else {
            $userUtilCardsRepository->setCardCount(($userUtilCardsRepository->getCardCount()) + 1);
        }

        $this->entityManager->flush();

        return new Response(null, 204);
    }

    public function newCards($user)
    {

        $charCards = $this->entityManager->getRepository(CharCard::class)->amateurPack();
        $utilCards = $this->entityManager->getRepository(UtilCard::class)->amateurPack();


        $randCharIndex = array_rand($charCards, 5);
        $randUtilIndex = array_rand($utilCards, 3);

        $randomCharCards = [];
        $randomUtilCards = [];


        for ($i = 0; $i < count($randCharIndex); $i++) {
            $randomCharCards[$i] = $charCards[$randCharIndex[$i]];
            $this->insertCharCard($user, $randomCharCards[$i]);
        }

        for ($i = 0; $i < count($randUtilIndex); $i++) {
            $randomUtilCards[$i] = $utilCards[$randUtilIndex[$i]];
            $this->insertUtilCard($user, $randomUtilCards[$i]);
        }


//        return $this->render('first_cards/new.html.twig', ['charCards' => $randomCharCards, 'utilCards' => $randomUtilCards]);
        return new Response(null, 204);
    }




}
