<?php

namespace App\Controller;

use App\Entity\UserCharDecks;
use App\Form\UserCharDeckType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

            $entityManager->persist($deck);
            $entityManager->flush();

            $this->addFlash("success", 'Deck created successfully');

            return $this->redirectToRoute('user_decks_show');

        }

        return $this->render('user_decks/newDeck.html.twig', [
             'charDeck'=>$form->createView()
        ]);
    }

    /**
     * @Route("/user/decks/{id}/edit", name="user_decks_edit")
     * @Security("has_role('ROLE_USER')")
     */
    public function editDeck(Request $request, UserCharDecks $decks)
    {

        $form = $this->createForm(UserCharDeckType::class, $decks);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $editDeck=$form->getData();

            $entityManager->persist($editDeck);
            $entityManager->flush();

            $this->addFlash('success','Deck successfully edited');

            return $this->redirectToRoute('user_decks_show');
        }
        return $this->render('user_decks/editDeck.html.twig', ['charDeck'=>$form->createView()]);
    }
}
