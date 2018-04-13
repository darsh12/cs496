<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\CharCard;
use App\Entity\CharCardStat;
use App\Repository\CharCardRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
//    }

    /**
     * @Route("inventory/card-catalog", name="card_show")
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository(CharCard::class);

        $cards = $repository->findAllCardsSortByRatingDesc();

        return $this->render('card_catalog/index.html.twig', array('cards' => $cards));
    }
}
