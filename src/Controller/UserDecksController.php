<?php

namespace App\Controller;

use App\Entity\UserCharDecks;
use App\Entity\UserStat;
use App\Entity\UserUtilDecks;
use App\Form\UserCharDeckType;
use App\Form\UserUtilDeckType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserDecksController extends Controller {

    /**
     * @Route("/user/decks", name="user_decks_show")
     * @Security("has_role('ROLE_USER')")
     */
    public function showDeck() {

        $user = $this->getUser();


        $charDecks = $this->getDoctrine()->getRepository(UserCharDecks::class)->findBy(['user' => $user]);
        $utilDecks = $this->getDoctrine()->getRepository(UserUtilDecks::class)->findBy(['user' => $user]);
        return $this->render('user_decks/index.html.twig', ['charDeck' => $charDecks, 'utilDeck' => $utilDecks]);

    }

    /**
     * @Route("/user/decks/new/char", name="user_char_decks_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newCharDeck(Request $request, ObjectManager $manager) {
        $user = $this->getUser();
        $netWorth = ['Bronze' => 1000, 'Silver' => 1500, 'Gold' => 2000, 'Platinum' => 2500, 'Diamond' => 3000, 'Elite' => 3500];
        $userRank = $manager->getRepository(UserStat::class)->findOneBy(['user' => $user]);
        $rankName = ProfileController::getRankName($userRank->getUserRank());
        //Strip the rank number
        $strippedRankName = substr($rankName, 0, strrpos($rankName, ' '));

        if (!array_key_exists($strippedRankName, $netWorth)) {
            $this->addFlash('error', 'Something went wrong. Please try again later');
            throw new NotFoundHttpException('Net worth not found');
        }
        $userNetWorth = $netWorth[$strippedRankName];


        $form = $this->createForm(UserCharDeckType::class);
        $userCharDeckRepo = $manager->getRepository(UserCharDecks::class)->findBy(['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $deck = $form->getData();
            $deck->setUser($user);


            $name = $deck->getName();
            $card1 = $deck->getCard1();
            $card2 = $deck->getCard2();
            $card3 = $deck->getCard3();
            $card4 = $deck->getCard4();
            $card5 = $deck->getCard5();

            $usedNetWorth = $card1->getCharCard()->getNetWorth() + $card2->getCharCard()->getNetWorth() + $card3->getCharCard()->getNetWorth() + $card4->getCharCard()->getNetWorth() + $card5->getCharCard()->getNetWorth();
            $remainingNetworth = (integer)$_POST['usernetworth'];

            if (($userNetWorth - $usedNetWorth) !== $remainingNetworth) {
                $this->addFlash('error', 'Somewhere something happened. Please try again later');
                return $this->redirectToRoute('user_decks_show');
            }

            if (($userNetWorth - $usedNetWorth) < 0) {
                $this->addFlash('error', 'You have exceeded your networth. Please choose different characters');
                return $this->redirectToRoute('user_decks_show');
            }


            for ($i = 0; $i < sizeof($userCharDeckRepo); $i++) {
                if ($name === ($userCharDeckRepo[$i]->getName())) {
                    $this->addFlash('error', 'Char deck name in use');
                    return $this->redirectToRoute('user_decks_show');
                }

            }

            if (($card1 === $card2) || ($card1 === $card3) || ($card1 === $card4) || ($card1 === $card5) ||
                ($card2 === $card3) || ($card2 === $card4) || ($card2 === $card3) || ($card2 === $card5) ||
                ($card3 === $card4) || ($card3 === $card5) ||
                ($card4 === $card5)) {
                $this->addFlash('error', 'Cannot have the same card twice in the same deck');
                return $this->redirectToRoute('user_decks_show');
            }

            $entityManager->persist($deck);
            $entityManager->flush();

            $this->addFlash("success", 'Deck ' . ($deck->getName()) . ' created successfully');

            return $this->redirectToRoute('user_decks_show');

        }

        return $this->render('user_decks/newCharDeck.html.twig', [
            'charDeck' => $form->createView(), 'userNetWorth' => $userNetWorth
        ]);
    }

    /**
     * @Route("/user/decks/new/util", name="user_util_decks_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newUtilDeck(Request $request, ObjectManager $manager) {
        $user = $this->getUser();

        $form = $this->createForm(UserUtilDeckType::class);
        $userUtilDeckRepo = $manager->getRepository(UserUtilDecks::class)->findBy(['user' => $user]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $deck = $form->getData();
            $deck->setUser($user);

            $name = $deck->getName();
            $card1 = $deck->getCard1();
            $card2 = $deck->getCard2();
            $card3 = $deck->getCard3();

            for ($i = 0; $i < sizeof($userUtilDeckRepo); $i++) {
                if ($name === ($userUtilDeckRepo[$i]->getName())) {
                    $this->addFlash('error', 'Util deck name in use');
                    return $this->redirectToRoute('user_decks_show');
                }

            }

            if (($card1 === $card2) || ($card1 === $card3) ||
                ($card2 === $card3)) {
                $this->addFlash('error', 'Cannot have the same card twice in the same deck');
                return $this->redirectToRoute('user_decks_show');
            }

            $entityManager->persist($deck);

            $entityManager->flush();

            $this->addFlash("success", 'Deck ' . ($deck->getName()) . ' created successfully');

            return $this->redirectToRoute('user_decks_show');

        }

        return $this->render('user_decks/newUtilDeck.html.twig', [
            'utilDeck' => $form->createView()
        ]);
    }


    /**
     * @Route("/user/decks/{id}/delete/char", name="user_char_decks_delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("POST")
     */
    public function deleteCharDeck(ObjectManager $manager, $id) {

        $user = $this->getUser();
        $userCharDecks = $manager->getRepository(UserCharDecks::class)->find($id);

        if ((!$userCharDecks) || ($userCharDecks->getUser() !== $user)) {
            $this->addFlash('error', 'Card deck not found');
            throw  new NotFoundHttpException("Card deck not found");
        }

        $name = $userCharDecks->getName();

        $manager->remove($userCharDecks);

        try {
            $manager->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', 'Cannot delete char deck ' . $name . '. Card is in a battle');
            $data = [
                'success' => false,
                'url' => $this->generateUrl('user_decks_show')
            ];

            return new JsonResponse($data);
        }

        $this->addFlash('success', 'Deck deleted');

        $data = [
            'success' => true,
            'url' => $this->generateUrl('user_decks_show')
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/user/decks/{id}/delete/util", name="user_util_decks_delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("POST")
     */
    public function deleteUtilDeck(ObjectManager $manager, $id) {

        $user = $this->getUser();
        $userUtilDecks = $manager->getRepository(UserUtilDecks::class)->find($id);


        if ((!$userUtilDecks) || ($userUtilDecks->getUser() !== $user)) {
            $this->addFlash('error', 'Card deck not found');
            throw  new NotFoundHttpException("Card deck not found");
        }
        $name = $userUtilDecks->getName();

        $manager->remove($userUtilDecks);
        try {
            $manager->flush();
        } catch (ForeignKeyConstraintViolationException $e) {
            $this->addFlash('error', 'Cannot delete util deck ' . $name . '. Card is in a battle');
            $data = [
                'success' => false,
                'url' => $this->generateUrl('user_decks_show')
            ];
            return new JsonResponse($data);

        }
        $this->addFlash('success', 'Deck deleted');

        $data = [
            'success' => true,
            'url' => $this->generateUrl('user_decks_show')
        ];

        return new JsonResponse($data);
    }


}
