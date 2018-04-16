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

        $userCharCards = $this->entityManager->getRepository('App:User')->find($user);

        return $this->render('first_cards/index.html.twig', ['user' => $userCharCards]);
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
            $randomUtilCards[$i] = $utilCards[$randUtilIndex[$i]];

            $this->insertCharCard($user, $randomCharCards[$i]);
            $this->insertUtilCard($user, $randomUtilCards[$i]);
        }

        return $this->render('first_cards/new.html.twig', ['charCards' => $randomCharCards, 'utilCards' => $randomUtilCards]);
    }


    /**
     * @Route("/first/sell/charCard/{cardId}", name="sell_user_char_card")
     * @Method("DELETE")
     */
    public function sellUserCharCard($cardId)
    {
        $userId = $this->getUser()->getId();

        $userCharCard = $this->entityManager->getRepository(UserCharCards::class)->findOneBy(['user' => $userId, 'char_card' => $cardId]);

        $price = $userCharCard->getCharCard()->getPrice();
        $count = $userCharCard->getCardCount();

        if (!$userCharCard) {
            throw  new Exception("Card not found");
        }

        if ($count > 1) {
            $userCharCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userCharCard);
        }
        $userCharCard->getUser()->setCoins($price * 0.5);

        $this->entityManager->flush();
        $this->addFlash('success', 'Card Sold');

        return new Response(null, 204);

    }

    /**
     * @Route("/first/sell/utilCard/{cardId}", name="sell_user_util_card")
     * @Method("DELETE")
     */
    public function sellUserUtilCard($cardId)
    {
        $userId = $this->getUser()->getId();
        $userUtilCard = $this->entityManager->getRepository('App:UserUtilCards')->findOneBy(['user' => $userId, 'util_card' => $cardId]);
        if (!$userUtilCard) {
            throw  new Exception("Card not found");
        }

        $this->entityManager->remove($userUtilCard);
        $this->entityManager->flush();

        return new Response(null, 204);

    }

}
