<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserCharCards;
use App\Entity\UserUtilCards;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserCardsController extends Controller {
    protected $entityManager;

    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/user/cards", name="show_user_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function showUserCharCards() {
        $user = $this->getUser();

        $userCards = $this->entityManager->getRepository(User::class)->find($user);

        return $this->render('user_cards/index.html.twig', ['user' => $userCards]);
    }

    /**
     * @Route("/user/cards/sell/{cardId}/char", name="sell_user_char_card")
     * @Method("POST")
     */
    public function sellUserCharCard($cardId) {
        $user = $this->getUser();
        $userId = $user->getId();

        $userCharCard = $this->entityManager->getRepository(UserCharCards::class)->findOneBy(['user' => $userId, 'char_card' => $cardId]);

        $price = $userCharCard->getCharCard()->getPrice();
        $count = $userCharCard->getCardCount();
        $userCoins = $user->getCoins();

        $countDistinctCards = $this->entityManager->getRepository(UserCharCards::class)->distinctCharCards($user);

        //Check if the user has the card
        if (!$userCharCard) {
            throw  new NotFoundHttpException("Card not found");
        }

        //Check if the user has only five cards
        if ($countDistinctCards == 5) {
            //If he has only 5 card does the card he wants to sell only 1 card
            if ($count == 1) {
                $this->addFlash('error', 'You need to have at least 5 different cards');
                throw new Exception("Cannot delete card. Need to have at least 5 cards");
            }
        }

        if ($count > 1) {
            $userCharCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userCharCard);
        }
        $userCharCard->getUser()->setCoins($userCoins + ($price * 0.5));

        $this->entityManager->flush();

        $this->addFlash('success', 'Card Sold');

        return new Response(null, 204);

    }

    /**
     * @Route("/user/cards/sell/{cardId}/util", name="sell_user_util_card")
     */
    public function sellUserUtilCard($cardId) {
        $user = $this->getUser();
        $userId = $user->getId();

        $userUtilCard = $this->entityManager->getRepository(UserUtilCards::class)->findOneBy(['user' => $userId, 'util_card' => $cardId]);

        $price = $userUtilCard->getUtilCard()->getPrice();
        $count = $userUtilCard->getCardCount();
        $userCoins = $user->getCoins();

        $countDistinctCards = $this->entityManager->getRepository(UserUtilCards::class)->distinctUtilCards($user);

        if (!$userUtilCard) {
            throw  new NotFoundHttpException("Card not found");
        }

        if ($countDistinctCards == 3) {
            if ($count == 1) {
                $this->addFlash('error', 'You need to have at least 3 different cards');
                throw new Exception("Cannot delete card. Need to have at least 3 cards");

            }
        }

        if ($count > 1) {
            $userUtilCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userUtilCard);
        }
        $userUtilCard->getUser()->setCoins($userCoins + ($price * 0.75));

        $this->entityManager->flush();
        $this->addFlash('success', 'Card Sold');

        return new Response(null, 204);

    }


}
