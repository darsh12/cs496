<?php

namespace App\Controller;

use App\Entity\CharCard;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FirstCardsController extends Controller
{
    /**
     * @Route("/first/cards", name="first_cards")
     * @Security("has_role('ROLE_USER')")
     */
    public function index(EntityManagerInterface $entityManager)
    {

        $repo = $entityManager->getRepository(CharCard::class);
        $cards = $repo->findAllCards();

        return $this->render('first_cards/index.html.twig', ['cards'=>$cards]);

    }


}
