<?php

namespace App\Controller;

use App\Entity\UserCharDecks;
use App\Form\UserCharDeckType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SensioLabs\Security\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\LogicException;

class UserDecksController extends Controller
{
    /**
     * @Route("/user/decks", name="user_decks_show")
     * @Security("has_role('ROLE_USER')")
     */
    public function showDeck()
    {

        $user=$this->getUser();

        $decks=$this->getDoctrine()->getRepository('App:UserCharDecks')->findBy(['user'=>$user]);
        return $this->render('user_decks/index.html.twig', ['userDecks'=>$decks]);

    }

    /**
     * @Route("/user/decks/new", name="user_decks_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newDeck(Request $request)
    {
        $user=$this->getUser();

        $form=$this->createForm(UserCharDeckType::class);


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $deck = $form->getData();
            $deck->setUser($user);

            $card1=$deck->getCard1();
            $card2=$deck->getCard2();
            $card3=$deck->getCard3();
            $card4=$deck->getCard4();
            $card5=$deck->getCard5();

            $card1->setCardDeckUses(($card1->getCardDeckUses())+1);
            $card2->setCardDeckUses(($card2->getCardDeckUses())+1);
            $card3->setCardDeckUses(($card3->getCardDeckUses())+1);
            $card4->setCardDeckUses(($card4->getCardDeckUses())+1);
            $card5->setCardDeckUses(($card5->getCardDeckUses())+1);


            if (($card1->getCardDeckUses())>($card1->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for '.($card1->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card2->getCardDeckUses())>($card2->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for '.($card2->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card3->getCardDeckUses())>($card3->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for '.($card3->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card4->getCardDeckUses())>($card4->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for '.($card4->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }
            if (($card5->getCardDeckUses())>($card5->getCardCount())) {
                $this->addFlash('error', 'Card Limit reached for '.($card5->getCharCard()->getCharName()));
                throw new LogicException("Card limit reached");
            }

            $entityManager->persist($deck);
            $entityManager->flush();

            $this->addFlash("success", 'Deck '.($deck->getName()) . ' created successfully');

            return $this->redirectToRoute('user_decks_show');

        }

        return $this->render('user_decks/newDeck.html.twig', [
             'charDeck'=>$form->createView()
        ]);
    }


     // @Route("/user/decks/{id}/edit", name="user_decks_edit")
     // @Security("has_role('ROLE_USER')")

    private function editDeck(Request $request, UserCharDecks $decks) {

        $user = $this->getUser();

        if (($decks->getUser()) === $user) {
            $form = $this->createForm(UserCharDeckType::class, $decks);


            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();

                $editDeck = $form->getData();

                $entityManager->persist($editDeck);
                $entityManager->flush();

                $this->addFlash('success', 'Deck successfully edited');

                return $this->redirectToRoute('user_decks_show');
            }
            return $this->render('user_decks/editDeck.html.twig', ['charDeck' => $form->createView()]);
        }else {
            throw new LogicException("Card deck not found",404);
        }
    }

    /**
     * @Route("/user/decks/{id}/delete", name="user_decks_delete")
     * @Security("has_role('ROLE_USER')")
     * @Method("POST")
     */
    public function deleteDeck(ObjectManager $manager, $id) {

        $user = $this->getUser();
        $userCardDecks=$manager->getRepository(UserCharDecks::class)->find($id);

        if ((!$userCardDecks) || ($userCardDecks->getUser() !== $user)) {
            $this->addFlash('error', 'Card deck not found');
            throw  new HttpException("Card deck not found", 400);
        }

        $card1=$userCardDecks->getCard1();
        $card2=$userCardDecks->getCard2();
        $card3=$userCardDecks->getCard3();
        $card4=$userCardDecks->getCard4();
        $card5=$userCardDecks->getCard5();

        $card1->setCardDeckUses(($card1->getCardDeckUses())-1);
        $card2->setCardDeckUses(($card2->getCardDeckUses())-1);
        $card3->setCardDeckUses(($card3->getCardDeckUses())-1);
        $card4->setCardDeckUses(($card4->getCardDeckUses())-1);
        $card5->setCardDeckUses(($card5->getCardDeckUses())-1);

        $manager->remove($userCardDecks);
        $manager->flush();

        $this->addFlash('success', 'Deck deleted');

//        return $this->redirectToRoute('user_decks_show');
        return new Response(null, 204);
    }
}
