<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\CharCard;
use App\Entity\CustomCard;
use App\Entity\CustomCardVote;
use App\Form\CustomCardType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CustomCardController extends Controller
{
    /***** select queue functions *****/
    /**
     * @Route("/custom-card/select-queue", name="custom_card_select_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showCustomCardSelectQueue()
    {
        $repository = $this->getDoctrine()->getRepository(CustomCard::class);
        $user=$this->getUser();

        $cards = $repository->findAllCardsSortByDateTimeAsc();

        return $this->render('custom_card/select-queue.html.twig', ['cards' => $cards, 'user' => $user]);
    }

    /**
     * @Route("/custom-card/select-queue/accept/{cardId}", name="custom_card_select_accept")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function acceptCustomCard($cardId)
    {
        $em = $this->getDoctrine()->getManager();
        $customCard = $em->getRepository(CustomCard::class)->find($cardId);

        // check if the custom card exists
        if (!$customCard) {
            throw new NotFoundHttpException("Card not found");
        }

        date_default_timezone_set('America/Chicago');
        $currDateTime = new \DateTime();

        $customCard->setDateAccepted($currDateTime);

        $em->persist($customCard);
        $em->flush();

        $ccName = $customCard->getCharName();
        $ccDateTime = $customCard->getDateCreated();

        $this->addFlash('success', 'Card '. $cardId . '_' . $ccName . '_' . $ccDateTime->format('Y-m-d-H-m-s') . ' has been accepted');
        return new Response(null, 204);
    }

    /**
     * @Route("/custom-card/select-queue/remove/{cardId}", name="custom_card_select_remove")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeCustomCard($cardId)
    {
        $em = $this->getDoctrine()->getManager();
        $customCard = $em->getRepository(CustomCard::class)->find($cardId);

        // check if the custom card exists
        if (!$customCard) {
            throw new NotFoundHttpException("Card not found");
        }

        $ccName = $customCard->getCharName();
        $ccDateTime = $customCard->getDateCreated();

        $this->removeImage($customCard->getImageFile());

        $em->remove($customCard);
        $em->flush();

        $this->addFlash('success', 'Card '. $cardId . '_' . $ccName . '_' . $ccDateTime->format('Y-m-d-H-m-s') . ' has been removed');
        return new Response(null, 204);
    }

    /***** voting page functions *****/
    /**
     * @Route("/custom-card/voting", name="custom_card_vote_show")
     * @Security("has_role('ROLE_USER')")
     */
    public function showCustomCardVoting()
    {
        $repoCustomCard = $this->getDoctrine()->getRepository(CustomCard::class);
        $repoCustomCardVote = $this->getDoctrine()->getRepository(CustomCardVote::class);
        $user = $this->getUser();

        $cards = $repoCustomCard->findAllCardsSortByDateTimeAsc();
        $cardVotes = $repoCustomCardVote->findAll();

        return $this->render('custom_card/voting.html.twig', ['cards' => $cards, 'user' => $user, 'cardVotes' => $cardVotes]);
    }

    /**
     * @Route("/custom-card/voting/perc-desc", name="custom_card_vote_perc_desc")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showCustomCardVotePercDesc()
    {
        $repoCustomCard = $this->getDoctrine()->getRepository(CustomCard::class);
        $repoCustomCardVote = $this->getDoctrine()->getRepository(CustomCardVote::class);
        $user = $this->getUser();

        $cards = $repoCustomCard->findAllCardsSortByVotePercDesc();
        $cardVotes = $repoCustomCardVote->findAll();

        return $this->render('custom_card/voting.html.twig', ['cards' => $cards, 'user' => $user, 'cardVotes' => $cardVotes]);
    }

    /**
     * @Route("/custom-card/voting/add/{cardId}", name="custom_card_vote_add")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addCharCard($cardId)
    {
        $em = $this->getDoctrine()->getManager();
        $customCard = $em->getRepository(CustomCard::class)->find($cardId);

        // check if the custom card exists
        if (!$customCard) {
            throw new NotFoundHttpException("Card not found");
        }

        $charCard = new CharCard();
        $charCardImg = new Avatar();

        $charCard->setCharName(ucwords($customCard->getCharName()));
        $charCard->setCharType($customCard->getCharType());
        $charCard->setCharClass($customCard->getCharClass());
        $charCard->setCharTier($customCard->getCharTier());
        $charCard->setCharType($customCard->getCharType());
        $charCard->setRating($customCard->getRating());
        $charCard->setHitPoints($customCard->getHitPoints());
        $charCard->setAttack($customCard->getAttack());
        $charCard->setDefense($customCard->getDefense());
        $charCard->setLuck($customCard->getLuck());
        $charCard->setAgility($customCard->getAgility());
        $charCard->setSpeed($customCard->getSpeed());

        $charCard->setPrice($this->setCustomCardPricing($customCard->getRating()));

        $charCardImg->setImagePath($customCard->getImageFile());
        $charCard->setAvatar($charCardImg);

        $em->persist($charCard);
        $em->persist($charCardImg);
        $em->remove($customCard);
        $em->flush();

        $this->addFlash('success', 'Character card has been added');
        return new Response(null, 204);
    }

    /**
     * @Route("/custom-card/voting/remove/{cardId}", name="custom_card_vote_remove")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeVoteCustomCard($cardId)
    {
        $em = $this->getDoctrine()->getManager();
        $customCard = $em->getRepository(CustomCard::class)->find($cardId);

        // check if the custom card exists
        if (!$customCard) {
            throw new NotFoundHttpException("Card not found");
        }

        $this->removeImage($customCard->getImageFile());

        $em->remove($customCard);
        $em->flush();

        $this->addFlash('success', 'Custom card has been removed');
        return new Response(null, 204);
    }

    /**
     * @Route("/custom-card/voting/up/{cardId}", name="custom_card_vote_up")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     */
    public function upVoteCustomCard($cardId)
    {
        $em = $this->getDoctrine()->getManager();
        $customCard = $em->getRepository(CustomCard::class)->find($cardId);

        // check if the custom card exists
        if (!$customCard) {
            throw new NotFoundHttpException("Card not found");
        }

        $customCardVote = new CustomCardVote();

        $customCardVote->setUser($this->getUser());
        $customCardVote->setCustomCard($customCard);
        $customCardVote->setVote('Up');

        $em->persist($customCardVote);
        $em->flush();

        $customCard->setVotePerc($this->getCustomCardVotePerc($cardId));

        $em->persist($customCard);
        $em->flush();

        $this->addFlash('success', 'Custom card vote has been updated');
        return new Response(null, 204);
    }

    /**
     * @Route("/custom-card/voting/down/{cardId}", name="custom_card_vote_down")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     */
    public function downVoteCustomCard($cardId)
    {
        $em = $this->getDoctrine()->getManager();
        $customCard = $em->getRepository(CustomCard::class)->find($cardId);

        // check if the custom card exists
        if (!$customCard) {
            throw new NotFoundHttpException("Card not found");
        }

        $customCardVote = new CustomCardVote();

        $customCardVote->setUser($this->getUser());
        $customCardVote->setCustomCard($customCard);
        $customCardVote->setVote('Down');

        $em->persist($customCardVote);
        $em->flush();

        $customCard->setVotePerc($this->getCustomCardVotePerc($cardId));

        $em->persist($customCard);
        $em->flush();

        $this->addFlash('success', 'Custom card vote has been updated');
        return new Response(null, 204);
    }

    private function getCustomCardVotePerc($cardId) {
        $em = $this->getDoctrine()->getManager();
        $customCardVoteData = $em->getRepository(CustomCardVote::class);

        $ccTotalVotes = $customCardVoteData->getTotalVoteCount($cardId);
        $ccUpVotes = $customCardVoteData->getUpVoteCount($cardId);
        $ccDownVotes = $customCardVoteData->getDownVoteCount($cardId);

        $ccVotePerc = 0;
        $ccUpVotePerc = (integer)$ccUpVotes[1] / (integer)$ccTotalVotes[1];
        $ccDownVotePerc = (integer)$ccDownVotes[1] / (integer)$ccTotalVotes[1];

        if($ccUpVotePerc > $ccDownVotePerc) {
            $ccVotePerc = $ccUpVotePerc;
        } elseif ($ccDownVotePerc > $ccUpVotePerc) {
            $ccVotePerc = -($ccDownVotePerc);
        }

        $ccVotePerc = $ccVotePerc * 100;

        return $ccVotePerc;
    }

    /***** custom card creation functions *****/
    /**
     * @Route("/custom-card", name="custom_card")
     * @Security("has_role('ROLE_USER')")
     */
    public function createCustomCard(Request $request)
    {
        $user = $this->getUser();
        date_default_timezone_set('America/Chicago');
        $currDateTime = new \DateTime();

        $form = $this->createForm(CustomCardType::class);

        // set original values for stat sliders
        $form->get('hitpoints')->setData('75');
        $form->get('attack')->setData('75');
        $form->get('defense')->setData('75');
        $form->get('luck')->setData('75');
        $form->get('agility')->setData('75');
        $form->get('speed')->setData('5');

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
            $cardRating = $this->setCustomCardRating($form);
            $customCard->setRating($cardRating);
            $customCard->setCharTier($this->setCustomCardTier($cardRating));
            $customCard->setDateCreated($currDateTime);

            $entityManager->persist($customCard);
            $entityManager->flush();

            return $this->showCustomCardSuccess($customCard->getDateCreated());
        }

        return $this->render('custom_card/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/custom-card/success", name="custom_card_success")
     * @Security("has_role('ROLE_USER')")
     */
    public function showCustomCardSuccess($dateCreated)
    {
        $repository = $this->getDoctrine()->getRepository(CustomCard::class);
        $user=$this->getUser();

        $card = $repository->findOneCardByLastEntry($dateCreated);

        return $this->render('custom_card/success.html.twig', ['card' => $card, 'user' => $user]);
    }

    // generate unique file name using character name and datetime created
    private function generateFileName($form, $currDateTime) {
        $fileName = 'ccc_';
        $names = explode(' ', $form->get('char_name')->getData());

        foreach ($names as $name) {
            $fileName = $fileName . $name . '_';
        }

        $strDateTime = $currDateTime->format('Y-m-d_H-i-s');
        $fileName = $strDateTime . '_' . $fileName;

        return $fileName;
    }

    // sets custom card rating to average of all tens place stats
    private function setCustomCardRating($form) {
        $hp = $form->get('hitpoints')->getData();
        $att = $form->get('attack')->getData();
        $def = $form->get('defense')->getData();
        $lck = $form->get('luck')->getData();
        $agi = $form->get('agility')->getData();

        $rating = ((int)$hp + (int)$att + (int)$def + (int)$lck + (int)$agi) / 5;

        return $rating;
    }

    // sets custom card tier based on rating value
    private function setCustomCardTier($rating) {
        $charTier = "";

        if($rating >= 50 && $rating <= 68) {
            $charTier = "Amateur";
        } elseif ($rating >= 69 && $rating <= 81) {
            $charTier = "Professional";
        } elseif ($rating >= 82 && $rating <= 99) {
            $charTier = "World Star";
        }

        return $charTier;
    }

    private function setCustomCardPricing($rating)
    {
        $ratingDiff = $rating - 50;

        if ($rating >= 96) {
            $raiseBonus = $ratingDiff * 30;
        } elseif($rating >= 90) {
            $raiseBonus = $ratingDiff * 15;
        } else {
            $raiseBonus = $ratingDiff * 5;
        }

        $raiseMult = ($ratingDiff / 7) * 2;
        $raiseMultBase = ($ratingDiff / 10) * 5;

        if($rating >= 95) {
            $raiseBase = 500;
        } elseif($rating >= 900) {
            $raiseBase = 300;
        } elseif($rating >= 82) {
            $raiseBase = 100;
        } elseif($rating >= 69) {
            $raiseBase = 55;
        } else {
            $raiseBase = 25;
        }

        return $raiseBonus + ($raiseMult * $raiseMultBase) + $raiseBase;
    }

    private function removeImage($image) {
        $fileSystem = new Filesystem();
        $path = $this->getParameter('custom_char_card_dir').'/'.$image;
        $fileSystem->remove($path);
    }
}
