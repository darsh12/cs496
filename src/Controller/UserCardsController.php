<?php

namespace App\Controller;

use App\Entity\UserCharCards;
use App\Entity\UserUtilCards;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserCardsController extends Controller {
    protected $entityManager;

    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/inventory", name="show_user_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function showUserCharCards() {
        $user = $this->getUser();

        $userCharCards = $this->entityManager->getRepository(UserCharCards::class)->orderBy($user);
        $userUtilCards = $this->entityManager->getRepository(UserUtilCards::class)->orderBy($user);

        return $this->render('user_cards/index.html.twig', ['user' => $user, 'charCard' => $userCharCards, 'utilCard' => $userUtilCards]);
    }

    /**
     * @Route("/user/cards/sell/{cardId}/char", name="sell_user_char_card")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     */
    public function sellUserCharCard($cardId) {
        $user = $this->getUser();
        $userId = $user->getId();

        $userCharCard = $this->entityManager->getRepository(UserCharCards::class)->findOneBy(['user' => $userId, 'char_card' => $cardId]);

        //Check if the user has the card
        if (!$userCharCard) {
            throw  new NotFoundHttpException("Card not found");
        }

        $price = $userCharCard->getCharCard()->getPrice();
        $count = $userCharCard->getCardCount();
        $userCoins = $user->getCoins();
        $name = $userCharCard->getCharCard()->getCharName();

        $countDistinctCards = $this->entityManager->getRepository(UserCharCards::class)->distinctCharCards($user);



        //Check if the user has only five cards
        if ($countDistinctCards == 5) {
            //If he has only 5 card does the card he wants to sell only 1 card
            if ($count == 1) {
                $this->addFlash('error', 'You need to have at least 5 different cards');
                throw new HttpException(403, "Cannot delete card. Need to have at least 5 cards");
            }
        }

        if ($count > 1) {
            $userCharCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userCharCard);
        }
        $userCharCard->getUser()->setCoins($userCoins + ($price * 0.5));

        try {
            $this->entityManager->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', 'Cannot sell ' . $name . '. Card is in a deck');
            $data = ['success' => false, 'url' => $this->generateUrl('show_user_cards')];
            return new JsonResponse($data);
        }

        $this->addFlash('success', 'Card Sold');

        $data = [
            'success' => true,
            'url' => $this->generateUrl('show_user_cards')
        ];

        return new JsonResponse($data);

    }

    /**
     * @Route("/user/cards/sell/{cardId}/util", name="sell_user_util_card")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     */
    public function sellUserUtilCard($cardId) {
        $user = $this->getUser();
        $userId = $user->getId();

        $userUtilCard = $this->entityManager->getRepository(UserUtilCards::class)->findOneBy(['user' => $userId, 'util_card' => $cardId]);


        if (!$userUtilCard) {
            throw  new NotFoundHttpException("Card not found");
        }

        $price = $userUtilCard->getUtilCard()->getPrice();
        $count = $userUtilCard->getCardCount();
        $userCoins = $user->getCoins();
        $name = $userUtilCard->getUtilCard()->getUtilName();

        $countDistinctCards = $this->entityManager->getRepository(UserUtilCards::class)->distinctUtilCards($user);


        if ($countDistinctCards == 3) {
            if ($count == 1) {
                $this->addFlash('error', 'You need to have at least 3 different cards');
                throw new HttpException(403, "Cannot delete card. Need to have at least 5 cards");

            }
        }

        if ($count > 1) {
            $userUtilCard->setCardCount($count - 1);

        } else {
            $this->entityManager->remove($userUtilCard);
        }
        $userUtilCard->getUser()->setCoins($userCoins + ($price * 0.75));

        try {
            $this->entityManager->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', 'Cannot sell ' . $name . '. Card is in a deck');
            $data = ['success' => false, 'url' => $this->generateUrl('show_user_cards')];
            return new JsonResponse($data);

        }
        $this->addFlash('success', 'Card Sold');

        $data = [
            'success' => true,
            'url' => $this->generateUrl('show_user_cards')
        ];

        return new JsonResponse($data);

    }


}
