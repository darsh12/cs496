<?php

namespace App\Controller;

use App\Entity\Achievement;
use App\Entity\Battle;
use App\Entity\CharCard;
use App\Entity\UtilCard;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AchievementController extends Controller {
    /**
     * @Route("/achievement", name="achievement")
     */
    public function winBattles(ObjectManager $manager) {
        $user = $this->getUser();
        $userCoins = $user->getCoins();

        $gotReward = false;
        $rewardType = "";
        $rewardCount = 0;
        $achievementDescription = "";

        $achievementType = $manager->getRepository(Achievement::class)->findBy(['type' => 'win']);
        $battleWins = $manager->getRepository(Battle::class)->totalWinCount($user);
        $battleWins = (integer)$battleWins;


        foreach ($achievementType as $achievement) {
            if (($achievement->getCountValue()) === $battleWins) {
                $achievementDescription = $achievement->getDescription();
                $rewardType = $achievement->getReward()->getType();
                $rewardCount = $achievement->getReward()->getValue();
                $gotReward = true;
            }
        }

        if ($gotReward === false) {
            return $this->redirectToRoute('app_homepage');
        }

        dump($achievementDescription, $rewardType, $rewardCount);

        if ($rewardType === 'coins') {
            $this->addFlash('success', 'You were rewarded with ' . $rewardCount . ' coins');
            $user->setCoins(($userCoins + $rewardCount));
        } else {
            $this->rewardPacks($rewardType);
        }

        $manager->flush();

        return new Response(null, 204);
    }

    public function rewardPacks($pack) {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $userCoins = $user->getCoins();

        $charCardRepository = $entityManager->getRepository(CharCard::class);
        $utilCardRepository = $entityManager->getRepository(UtilCard::class);


        $randomCharCards = [];
        $randomUtilCards = [];

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
                $this->get(FirstCardsController::class)->insertCharCard($user, $randomCharCards[$i]);
            }
            for ($i = 0; $i < count($randUtilIndex); $i++) {
                $randomUtilCards[$i] = $utilCardRepository[$randUtilIndex[$i]];
                $this->get(FirstCardsController::class)->insertUtilCard($user, $randomUtilCards[$i]);
            }

            if ($coins > 0) {
                $user->setCoins(($userCoins + $coins));
            }

            $this->addFlash('success', 'Got a Amateur pack !');


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
                $this->get(FirstCardsController::class)->insertCharCard($user, $randomCharCards[$i]);
            }
            for ($i = 0; $i < count($randUtilIndex); $i++) {
                $randomUtilCards[$i] = $utilCardRepository[$randUtilIndex[$i]];
                $this->get(FirstCardsController::class)->insertUtilCard($user, $randomUtilCards[$i]);
            }

            if ($coins > 0) {
                $user->setCoins(($userCoins + $coins));
            }

            $this->addFlash('success', 'Got a Professional pack !');


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
                $this->get(FirstCardsController::class)->insertCharCard($user, $randomCharCards[$i]);
            }
            for ($i = 0; $i < count($randUtilIndex); $i++) {
                $randomUtilCards[$i] = $utilCardRepository[$randUtilIndex[$i]];
                $this->get(FirstCardsController::class)->insertUtilCard($user, $randomUtilCards[$i]);
            }

            if ($coins > 0) {

                $user->setCoins(($userCoins + $coins));
            }

            $this->addFlash('success', 'Got a World Star pack !');

        }

        $entityManager->flush();


        return new Response(null, 204);
//        Return $this->render('card_packs/packs.html.twig', ['charCards' => $randomCharCards, 'utilCards' => $randomUtilCards, 'coins' => $coins]);


    }

}
