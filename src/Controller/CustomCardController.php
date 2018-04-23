<?php

namespace App\Controller;

use App\Entity\CustomCard;
use App\Form\CustomCardType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CustomCardController extends Controller
{
//    /**
//     * @Route("/inventory/custom-card", name="custom_card")
//     */
//    public function index()
//    {
//        return $this->render('custom_card/index.html.twig', [
//            'controller_name' => 'CustomCardController',
//        ]);
//    }

    /**
     * @Route("/inventory/custom-card", name="custom_card")
     */
    public function new(Request $request)
    {
        $user = $this->getUser();
        date_default_timezone_set('America/Chicago');
        $currDateTime = new \DateTime();

        $form = $this->createForm(CustomCardType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $customCard = $form->getData();

            // get image file
            $file = $form->get('image_file')->getData();

            // set file name for image file
            $fileName = $this->generateFileName($form, $currDateTime).'.'.$file->guessExtension();

            // move the file to the proper directory with the new filename
            $file->move(
                $this->getParameter('custom_char_card_dir'),
                $fileName
            );

            // database setters for anything not automatically set by values in form
            $customCard->setImageFile($fileName);
            $customCard->setUser($user);
            $customCard->setRating($this->setCustomCardRating($form));
            $customCard->setDateCreated($currDateTime);

            $entityManager->persist($customCard);
            $entityManager->flush();

            return $this->render('custom_card/success.html.twig');
        }

        return $this->render('custom_card/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    // generate unique file name using character name and datetime created
    private function generateFileName($form, $currDateTime) {
        $fileName = 'ccc_';
        $names = explode(' ', $form->get('char_name')->getData());

        foreach ($names as $name) {
            $fileName = $fileName . $name . '_';
        }

        $strDateTime = $currDateTime->format('Y-m-d_H-i-s');
        $fileName = $fileName . $strDateTime;

        return $fileName;
    }

    private function setCustomCardRating($form) {
        $hp = $form->get('hitpoints')->getData();
        $att = $form->get('attack')->getData();
        $def = $form->get('defense')->getData();
        $lck = $form->get('luck')->getData();
        $agi = $form->get('agility')->getData();

        $rating = ((int)$hp + (int)$att + (int)$def + (int)$lck + (int)$agi) / 5;

        return $rating;
    }
}
