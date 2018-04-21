<?php

namespace App\Controller;

use App\Entity\CharCard;
use App\Entity\User;
use App\Entity\UserCharCards;
use App\Entity\UserUtilCards;
use App\Entity\UtilCard;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstCardsController extends Controller
{

    protected $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/first/show", name="show_user_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function showUserCharCards()
    {
        $user = $this->getUser();

        $userCards = $this->entityManager->getRepository('App:User')->find($user);

        $utilCards=$this->entityManager->getRepository(UserUtilCards::class)->findBy(['user'=>$user]);
//        $utilAttributes=$utilCards->getAttributeModifier();

        return $this->render('first_cards/index.html.twig', ['user' => $userCards]);
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

    /**
     * @Route("/first/new", name="new_user_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function newCards()
    {


        $user = $this->getUser();

        $charCards = $this->entityManager->getRepository('App:CharCard')->findBy(['char_tier' => 'World Star']);
        $utilCards = $this->entityManager->getRepository('App:UtilCard')->findBy(['util_tier' => 'World Star']);


        $randCharIndex = array_rand($charCards, 2);
        $randUtilIndex = array_rand($utilCards, 2);

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


        return $this->render('first_cards/new.html.twig', ['charCards' => $randomCharCards, 'utilCards' => $randomUtilCards]);
    }

    /**
     * @Route("/first/sell/charCard/{cardId}", name="sell_user_char_card")
     * @Method("POST")
     */
    public function sellUserCharCard($cardId)
    {
        $user = $this->getUser();
        $userId=$user->getId();

        $userCharCard = $this->entityManager->getRepository(UserCharCards::class)->findOneBy(['user' => $userId, 'char_card' => $cardId]);

        $price = $userCharCard->getCharCard()->getPrice();
        $count = $userCharCard->getCardCount();
        $userCoins = $user->getCoins();

        $countDistinctCards= $this->entityManager->getRepository(UserCharCards::class)->distinctCharCards($user);

        //Check if the user has the card
        if (!$userCharCard) {
            throw  new Exception("Card not found");
        }

        //Check if the user has only five cards
        if ($countDistinctCards==5 ) {
            //If he has only 5 card does the card he wants to sell only 1 card
            if ($count==1) {
                $this->addFlash('error', 'You need to have at least 5 different cards');
                throw new Exception("Cannot delete card. Need to have at least 5 cards");
            }
        }

        if ($count > 1) {
            $userCharCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userCharCard);
        }
        $userCharCard->getUser()->setCoins($userCoins+($price * 0.5));

        $this->entityManager->flush();

        $this->addFlash('success', 'Card Sold');

        return new Response(null, 204);

    }

    /**
     * @Route("/first/sell/utilCard/{cardId}", name="sell_user_util_card")
     */
    public function sellUserUtilCard($cardId)
    {
        $user = $this->getUser();
        $userId=$user->getId();

        $userUtilCard = $this->entityManager->getRepository(UserUtilCards::class)->findOneBy(['user' => $userId, 'util_card' => $cardId]);

        $price = $userUtilCard->getUtilCard()->getPrice();
        $count = $userUtilCard->getCardCount();
        $userCoins = $user->getCoins();

        $countDistinctCards = $this->entityManager->getRepository(UserUtilCards::class)->distinctUtilCards($user);

        if (!$userUtilCard) {
            throw  new Exception("Card not found");
        }

        if ($countDistinctCards==3) {
            if ($count==1) {
                $this->addFlash('error', 'You need to have at least 3 different cards');
                throw new Exception("Cannot delete card. Need to have at least 3 cards");

            }
        }

        if ($count > 1) {
            $userUtilCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userUtilCard);
        }
        $userUtilCard->getUser()->setCoins($userCoins+($price * 0.75));

        $this->entityManager->flush();
        $this->addFlash('success', 'Card Sold');

        return new Response(null, 204);


    }

}
