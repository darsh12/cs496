<?php

namespace App\Controller;

use App\Entity\CharCard;
use App\Entity\CharCardStat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CardCatalogController extends Controller
{
//    /**
//     * @Route("/card-catalog", name="card-catalog")
//     */
//    public function index()
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $avatar = new Avatar();
//        $avatar->setImagePath('https://media.timeout.com/images/103833758/630/472/image.jpg');
//
//        $charStat = new CharCardStat();
//        $charStat->setHitPoints(80);
//        $charStat->setAttack(65);
//        $charStat->setDefense(80);
//        $charStat->setLuck(90);
//        $charStat->setAgility(40);
//        $charStat->setSpeed(8);
//
//        $card = new CharCard();
//        $card->setCharName('pow');
//        $card->setCharType('pow');
//        $card->setCharClass('pow');
//        $card->setCharTier('pow');
//        $card->setAvatarId($avatar);
//        $card->setCharStatId($charStat);
//
//        $entityManager->persist($avatar);
//        $entityManager->persist($charStat);
//        $entityManager->persist($card);
//
//        $entityManager->flush();
//
//        return $this->render('card_catalog/index.html.twig', [
//            'controller_name' => 'CardCatalogController',
//        ]);
//

    /**
     * @Route("inventory/card-catalog", name="card_show")
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository(CharCard::class);
        $user=$this->getUser();

        $cards = $repository->findAllCardsSortByRatingDesc();

        return $this->render('card_catalog/index.html.twig', ['cards' => $cards, 'user'=>$user]);
    }

    /**
     * @Route("/inventory/buy/card/{card}", name="inventory_buy_char")
     *
     */
    public function buyCharCard($card)
    {

        $user=$this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $charCard=$entityManager->getRepository(CharCard::class)->findOneBy(['id'=>$card]);

        if (!$charCard) {
            throw  new Exception("Card not found");
        }

        $userCoins=$user->getCoins();
        $cardCost=$charCard->getPrice();

        if ($userCoins<$cardCost) {
            $this->addFlash('error', 'Not enough coins');
            throw  new Exception("Not enough coins");
//            return $this->redirectToRoute('card_show');
        }
        $this->get('App\Controller\FirstCardsController')->insertCharCard($user, $charCard);
        $user->setCoins($userCoins-$cardCost);
        $entityManager->flush();

        $this->addFlash('success', 'Card successfully bought');

//        return $this->redirectToRoute('show_user_cards');
        return new Response(null, 204);

    }
}
