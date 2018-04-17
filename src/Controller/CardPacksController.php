<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardPacksController extends Controller {

    protected $entityManager;

    protected $packs = ["amateur" => 200, "professional" => 400, "world_star" => 800];


    public function __construct(ObjectManager $entityManager) {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/card/packs", name="card_packs")
     */
    public function index() {

        return $this->render('card_packs/index.html.twig', [
            'cost' => $this->packs
        ]);
    }


    /**
     * @Route("/card/packs/{pack}/buy", name="card_packs_buy")
     */
    public function buyPacks($pack) {

        $user = $this->getUser();
        $userCoins = $user->getCoins();

        $charCardRepository = $this->entityManager->getRepository('App:CharCard');
        $utilCardRepository = $this->entityManager->getRepository('App:UtilCard');


        $randomCharCards = [];
        $randomUtilCards = [];

        $cost = $this->packs[$pack];


        if (array_key_exists($pack, $this->packs)) {
            if ($userCoins >= $cost) {

                if ($pack == 'amateur') {

                    $charCardRepository = $charCardRepository->amateurPack();
                    $utilCardRepository = $utilCardRepository->amateurPack();

                    $randomCards = random_int(2, 4);
                    $remainingCards = 6 - $randomCards;

                    $coins = random_int(-10, 50);

                    $randCharIndex = array_rand($charCardRepository, $randomCards);
                    $randUtilIndex = array_rand($utilCardRepository, $remainingCards);

                    for ($i = 0; $i < count($randCharIndex); $i++) {
                        $randomCharCards[$i] = $charCardRepository[$randCharIndex[$i]];
                        $this->get('App\Controller\FirstCardsController')->insertCharCard($user, $randomCharCards[$i]);
                    }
                    for ($i = 0; $i < count($randUtilIndex); $i++) {
                        $randomUtilCards[$i] = $utilCardRepository[$randUtilIndex[$i]];
                        $this->get('App\Controller\FirstCardsController')->insertUtilCard($user, $randomUtilCards[$i]);
                    }

                    if ($coins > 0) {
                        $amount = ($userCoins+$coins)-$cost;
                        $user->setCoins($amount);
                    }else{
                        $amount = ($userCoins-$cost);
                        $user->setCoins($amount);
                    }
                    $this->entityManager->flush();

                    $this->addFlash('success', 'Successfully bought Amateur pack !');


                } elseif ($pack == 'professional') {

                    $charCardRepository = $charCardRepository->professionalPack();
                    $utilCardRepository = $utilCardRepository->professionalPack();

                    $randomCards = random_int(2, 4);
                    $remainingCards = 6 - $randomCards;

                    $coins = random_int(-10, 75);

                    $randCharIndex = array_rand($charCardRepository, $randomCards);
                    $randUtilIndex = array_rand($utilCardRepository, $remainingCards);

                    for ($i = 0; $i < count($randCharIndex); $i++) {
                        $randomCharCards[$i] = $charCardRepository[$randCharIndex[$i]];
                        $this->get('App\Controller\FirstCardsController')->insertCharCard($user, $randomCharCards[$i]);
                    }
                    for ($i = 0; $i < count($randUtilIndex); $i++) {
                        $randomUtilCards[$i] = $utilCardRepository[$randUtilIndex[$i]];
                        $this->get('App\Controller\FirstCardsController')->insertUtilCard($user, $randomUtilCards[$i]);
                    }

                    if ($coins > 0) {
                        $amount = ($userCoins+$coins)-$cost;
                        $user->setCoins($amount);
                    }else{
                        $amount = ($userCoins-$cost);
                        $user->setCoins($amount);
                    }
                    $this->entityManager->flush();

                    $this->addFlash('success', 'Successfully bought Professional pack !');


                } elseif ($pack == 'world_star') {

                    $charCardRepository = $charCardRepository->worldStarPack();
                    $utilCardRepository = $utilCardRepository->worldStarPack();

                    $randomCards = random_int(2, 4);
                    $remainingCards = 6 - $randomCards;

                    $coins = random_int(-10, 100);

                    $randCharIndex = array_rand($charCardRepository, $randomCards);
                    $randUtilIndex = array_rand($utilCardRepository, $remainingCards);

                    for ($i = 0; $i < count($randCharIndex); $i++) {
                        $randomCharCards[$i] = $charCardRepository[$randCharIndex[$i]];
                        $this->get('App\Controller\FirstCardsController')->insertCharCard($user, $randomCharCards[$i]);
                    }
                    for ($i = 0; $i < count($randUtilIndex); $i++) {
                        $randomUtilCards[$i] = $utilCardRepository[$randUtilIndex[$i]];
                        $this->get('App\Controller\FirstCardsController')->insertUtilCard($user, $randomUtilCards[$i]);
                    }

                    if ($coins > 0) {
                        $amount = ($userCoins+$coins)-$cost;
                        $user->setCoins($amount);
                    }else{
                        $amount = ($userCoins-$cost);
                        $user->setCoins($amount);
                    }
                    $this->entityManager->flush();

                    $this->addFlash('success', 'Successfully bought World Star pack !');

                }


            } else {
                $this->addFlash('error', 'Not enough coins');
                throw  new Exception("Not enough coins");
            }


        } else {
            $this->addFlash('error', "An error occurred. No such pack exists. Please try again later");
            throw new Exception("Card pack not found");
        }
        return new Response(null, 204);
//        Return $this->render('card_packs/packs.html.twig', ['charCards' => $randomCharCards, 'utilCards' => $randomUtilCards, 'coins' => $coins]);


    }

}
