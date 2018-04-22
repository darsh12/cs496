<?php

namespace App\Controller;

use App\Entity\UserCharDecks;
use App\Entity\UserUtilDecks;
use App\Form\UserCharDeckType;
use App\Form\UserUtilDeckType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\LogicException;

class UserDecksController extends Controller {
    /**
     * @Route("/user/decks", name="user_decks_show")
     * @Security("has_role('ROLE_USER')")
     */
    public function showDeck() {

        $user = $this->getUser();

        $charDecks = $this->getDoctrine()->getRepository(UserCharDecks::class)->findBy(['user' => $user]);
        $utilDecks=$this->getDoctrine()->getRepository(UserUtilDecks::class)->findBy(['user'=>$user]);
        return $this->render('user_decks/index.html.twig', ['charDeck' => $charDecks, 'utilDeck'=>$utilDecks]);

    }

    /**
     * @Route("/user/decks/new/char", name="user_char_decks_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newCharDeck(Request $request) {
        $user = $this->getUser();

        $form = $this->createForm(UserCharDeckType::class);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $deck = $form->getData();
            $deck->setUser($user);

            $card1 = $deck->getCard1();
            $card2 = $deck->getCard2();
            $card3 = $deck->getCard3();
            $card4 = $deck->getCard4();
            $card5 = $deck->getCard5();

            $card1->setCardDeckUses(($card1->getCardDeckUses()) + 1);
            $card2->setCardDeckUses(($card2->getCardDeckUses()) + 1);
            $card3->setCardDeckUses(($card3->getCardDeckUses()) + 1);
            $card4->setCardDeckUses(($card4->getCardDeckUses()) + 1);
            $card5->setCardDeckUses(($card5->getCardDeckUses()) + 1);


            if (($card1->getCardDeckUses()) > ($card1->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card1->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card2->getCardDeckUses()) > ($card2->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card2->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card3->getCardDeckUses()) > ($card3->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card3->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card4->getCardDeckUses()) > ($card4->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card4->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card5->getCardDeckUses()) > ($card5->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card5->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }

            $entityManager->persist($deck);
            $entityManager->flush();

            $this->addFlash("success", 'Deck ' . ($deck->getName()) . ' created successfully');

            return $this->redirectToRoute('user_decks_show');

        }

        return $this->render('user_decks/newCharDeck.html.twig', [
            'charDeck' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/decks/new/util", name="user_util_decks_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newUtilDeck(Request $request) {
        $user = $this->getUser();

        $form = $this->createForm(UserUtilDeckType::class);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $deck = $form->getData();
            $deck->setUser($user);

            $card1 = $deck->getCard1();
            $card2 = $deck->getCard2();
            $card3 = $deck->getCard3();


            $card1->setCardDeckUses(($card1->getCardDeckUses()) + 1);
            $card2->setCardDeckUses(($card2->getCardDeckUses()) + 1);
            $card3->setCardDeckUses(($card3->getCardDeckUses()) + 1);


            if (($card1->getCardDeckUses()) > ($card1->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card1->getUtilCard()->getUtilName()));
                throw new LogicException("Card limit reached");
            }
            if (($card2->getCardDeckUses()) > ($card2->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card2->getUtilCard()->getUtilName()));
                throw new LogicException("Card limit reached");
            }
            if (($card3->getCardDeckUses()) > ($card3->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for ' . ($card3->getUtilCard()->getUtilName()));
                throw new LogicException("Card limit reached");
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
            throw  new HttpException("Card deck not found", 404);
        }

        $card1 = $userCharDecks->getCard1();
        $card2 = $userCharDecks->getCard2();
        $card3 = $userCharDecks->getCard3();
        $card4 = $userCharDecks->getCard4();
        $card5 = $userCharDecks->getCard5();

        $card1->setCardDeckUses(($card1->getCardDeckUses()) - 1);
        $card2->setCardDeckUses(($card2->getCardDeckUses()) - 1);
        $card3->setCardDeckUses(($card3->getCardDeckUses()) - 1);
        $card4->setCardDeckUses(($card4->getCardDeckUses()) - 1);
        $card5->setCardDeckUses(($card5->getCardDeckUses()) - 1);

        $manager->remove($userCharDecks);
        $manager->flush();

        $this->addFlash('success', 'Deck deleted');

//        return $this->redirectToRoute('user_decks_show');
        return new Response(null, 204);
    }

    /**
     * @Route("/user/decks/{id}/delete/util", name="user_util_decks_delete")
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteUtilDeck(ObjectManager $manager, $id) {

        $user = $this->getUser();
        $userUtilDecks = $manager->getRepository(UserUtilDecks::class)->find($id);

        if ((!$userUtilDecks) || ($userUtilDecks->getUser() !== $user)) {
            $this->addFlash('error', 'Card deck not found');
            throw  new HttpException("Card deck not found", 404);
        }

        $card1 = $userUtilDecks->getCard1();
        $card2 = $userUtilDecks->getCard2();
        $card3 = $userUtilDecks->getCard3();


        $card1->setCardDeckUses(($card1->getCardDeckUses()) - 1);
        $card2->setCardDeckUses(($card2->getCardDeckUses()) - 1);
        $card3->setCardDeckUses(($card3->getCardDeckUses()) - 1);


        $manager->remove($userUtilDecks);
        $manager->flush();

        $this->addFlash('success', 'Deck deleted');

//        return $this->redirectToRoute('user_decks_show');
        return new Response(null, 204);
    }


}
