<?php

namespace App\Controller;

use App\Entity\CharCard;
use App\Entity\CharCardStat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
//        return $this->render('card_catalog/index.html.twig', [
//            'controller_name' => 'CardCatalogController',
//        ]);
//    }

    /**
     * @Route("/market", name="card_show_catalog")
     * @Security("has_role('ROLE_USER')")
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository(CharCard::class);
        $user=$this->getUser();

        $cards = $repository->findAllCardsSortByRatingDesc();

        return $this->render('card_catalog/index.html.twig', ['cards' => $cards, 'user'=>$user]);
    }

    /**
     * @Route("/inventory/buy/{card}/char", name="inventory_buy_char")
     * @Security("has_role('ROLE_USER')")
     * @Method("POST")
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
        $this->get(FirstCardsController::class)->insertCharCard($user, $charCard);
        $user->setCoins($userCoins-$cardCost);
        $entityManager->flush();

        $this->addFlash('success', 'Card successfully bought');

//        return $this->redirectToRoute('show_user_cards');
        return new Response(null, 204);

    }
}
