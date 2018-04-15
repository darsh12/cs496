<?php

namespace App\Controller;

use App\Entity\CharCard;
use App\Entity\User;
use App\Entity\UserCharCards;
use App\Entity\UserUtilCards;
use App\Entity\UtilCard;
use function PHPSTORM_META\type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstCardsController extends Controller
{

    /**
     * @Route("/first/show", name="show_user_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function showUserCharCards()
    {
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $userCharCards = $entityManager->getRepository('App:User')->find($user);

        return $this->render('first_cards/index.html.twig', ['charCards' => $userCharCards]);
    }


    /**
     * Used to insert a card to UserCharCards
     * @param User $user
     * @param CharCard $charCard
     */
    private function insertCharCard(User $user, CharCard $charCard)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $userCharCardsRepository = $entityManager->getRepository('App:UserCharCards')->findOneBy([
            'user' => $user, 'char_card' => $charCard]);

        /**
         * If card does not exist for user
         */
        if (!$userCharCardsRepository) {
            $userCharCards = new UserCharCards();
            $userCharCards->setUser($user);
            $userCharCards->setCharCard($charCard);
            $userCharCards->setCardCount(($userCharCards->getCardCount()) + 1);

            $entityManager->persist($userCharCards);
        } else {
            $userCharCardsRepository->setCardCount(($userCharCardsRepository->getCardCount()) + 1);
        }

        $entityManager->flush();

    }


    /**
     * Used to insert a card to UserUtilCards
     * @param User $user
     * @param UtilCard $utilCard
     */
    private function insertUtilCard(User $user, UtilCard $utilCard)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userUtilCardsRepository = $entityManager->getRepository('App:UserUtilCards')->findOneBy([
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

            $entityManager->persist($userUtilCards);
        } else {
            $userUtilCardsRepository->setCardCount(($userUtilCardsRepository->getCardCount()) + 1);
        }

        $entityManager->flush();

    }

    /**
     * @Route("/first/new", name="new_user_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function newCards()
    {


        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $charCards = $entityManager->getRepository('App:CharCard')->findBy(['char_tier' => 'World Star']);
        $utilCards = $entityManager->getRepository('App:UtilCard')->findBy(['util_tier' => 'World Star']);


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
     * @Route("/first/char/card/{cardId}/user/{userId}", name="remove_user_char_card")
     * @Method("DELETE")
     */
    public function removeUserCharCard($cardId, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userCharCard = $entityManager->getRepository('App:UserCharCards')->findOneBy(['user' => $userId, 'char_card' => $cardId]);

        if (!$userCharCard) {
            throw  new Exception("Card not found");
        }

        $entityManager->remove($userCharCard);
        $entityManager->flush();

        return new Response(null, 204);

    }

    /**
     * @Route("/first/util/card/{cardId}/user/{userId}", name="remove_user_util_card")
     * @Method("DELETE")
     */
    public function removeUserUtilCard($cardId, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userUtilCard = $entityManager->getRepository('App:UserUtilCards')->findOneBy(['user' => $userId, 'util_card' => $cardId]);

        if (!$userUtilCard) {
            throw  new Exception("Card not found");
        }

        $entityManager->remove($userUtilCard);
        $entityManager->flush();

        return new Response(null, 204);

    }


}
