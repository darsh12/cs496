<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\Battle;
use App\Entity\BattleRequest;
use App\Entity\UserStat;
use App\Form\UserAvatarType;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Form\Type\ChangePasswordFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// Controller for Profile Sub-Tabs
class ProfileController extends Controller
{
    /**
     * @Route("/my_profile/edit",name="app_my-profile-edit")
     * @Security("has_role('ROLE_USER')")
     */
    public function editProfile(Request $request, FileUploader $fileUploader, ObjectManager $manager)
    {
        $avatarDirectory = $this->getParameter('avatar_directory');

        $user = $this->getUser();
        $userName = $user->getUsername();

        // User Profile Avatar
        $userAvatar = $manager
            ->getRepository(Avatar::class)
            ->find($user->getAvatar());

        $profilePicturePath = $avatarDirectory.'/'.$userAvatar->getImagePath();

        // Create Image Upload Form
        $avatar =  new Avatar();
        $form=$this->createForm(UserAvatarType::class, $avatar);
        $form->handleRequest($request);

        $oldUserAvatar = $user->getAvatar()->getImagePath();
        $oldAvatar = $manager
            ->getRepository(Avatar::class)
            ->findOneBy(['image_path'=>$oldUserAvatar]);

        // Form Submission Handler
        if ($form->isSubmitted() && $form->isValid()) {

            $file=$form['image_path']->getData();

            $fileName = $fileUploader->uploadImage($file);

            $avatar->setImagePath($fileName);
            $avatar->addUser($user);

            if ($oldAvatar->getId() !== 15) {
                $fileUploader->removeImage($oldUserAvatar);
                $manager->remove($oldAvatar);
            }

            $manager->persist($avatar);
            $manager->flush();

            $this->addFlash('success', 'Profile Picture Updated');
            return $this->redirectToRoute('app_my-profile-edit');
        }


        // Create Change Password form
        $passForm = $this->createForm(ChangePasswordFormType::class, $user);
        $passForm->handleRequest($request);

        if ($passForm->isSubmitted() && $passForm->isValid()) {

            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            $this->addFlash('success', 'Password Updated');
            return $this->redirect($this->generateUrl('app_my-profile-edit'));
        }


        // Return Call
        return $this->render('profile/profile_edit.html.twig',
            [
                "user_name" => $userName,
                "profile_pic" => $profilePicturePath,
                'avatarForm'=>$form->createView(),
                "form" => $passForm->createView()
            ]);
    }

    /**
     * @Route("/my_profile/history",name="app_my-profile-history")
     * @Security("has_role('ROLE_USER')")
     */

    // Player's Battle History Page
    function battleHistory(ObjectManager $manager, Battle $battle, BattleRequest $battleRequest, String $type) {

        //TODO: Handle custom type condition and render individual macro
        $defCharDeck = $battle->getDefendCharDeck();
        $defUtilDeck = $battle->getDefendUtilDeck();
        $attCharDeck = $battleRequest->getAttackerCharDeck();
        $attUtilDeck = $battleRequest->getAttackerUtilDeck();

        $attChars = [
            $attCharDeck->getCard1()->getCharCard(),
            $attCharDeck->getCard2()->getCharCard(),
            $attCharDeck->getCard3()->getCharCard(),
            $attCharDeck->getCard4()->getCharCard(),
            $attCharDeck->getCard5()->getCharCard()
        ];
        $attUtils = [
            $attUtilDeck->getCard1()->getUtilCard(),
            $attUtilDeck->getCard2()->getUtilCard(),
            $attUtilDeck->getCard3()->getUtilCard()
        ];
        $defChars = [
            $defCharDeck->getCard1()->getCharCard(),
            $defCharDeck->getCard2()->getCharCard(),
            $defCharDeck->getCard3()->getCharCard(),
            $defCharDeck->getCard4()->getCharCard(),
            $defCharDeck->getCard5()->getCharCard()
        ];
        $defUtils = [
            $defUtilDeck->getCard1()->getUtilCard(),
            $defUtilDeck->getCard2()->getUtilCard(),
            $defUtilDeck->getCard3()->getUtilCard()
        ];

        // Return Call
        return $this->render('profile/profile_history.html.twig', [
            "battleRecordExists" => true,
            "battle" => $battle,
            "battle_request" => $battleRequest,
            "att_chars" => $attChars,
            "att_utils" => $attUtils,
            "def_chars" => $defChars,
            "def_utils" => $defUtils,
            "type" => $type
        ]);
    }

    // Route so I can grab the battleHistory macro w/ AJAX
    /**
     * @Route("/history/{type}",name="app_history-ajax")
     * @Security("has_role('ROLE_USER')")
     */

    function battleHistoryAJAX($type, ObjectManager $manager) {

        $user = $this->getUser();
        $userStat = $manager
            ->getRepository(UserStat::class)
            ->findOneBy(["user" => $user]);

        // Render Best Battle History
        if($type === "best") {

            $bestBattle = $userStat->getBestWinBattle();

            if(!$bestBattle) {
                // Return Call
                return $this->render('profile/profile_history.html.twig', [
                    "battleRecordExists" => false,
                    "type" => $type
                ]);
            }

            $bestBattleRequest = $bestBattle->getRequest();

            // Return default Battle History view
            return $this->battleHistory($manager, $bestBattle, $bestBattleRequest, "best");
        }

        // Render Worst Battle History
        elseif($type === "worst") {

            $worstBattle = $userStat->getWorstLostBattle();

            if(!$worstBattle) {
                // Return Call
                return $this->render('profile/profile_history.html.twig', [
                    "battleRecordExists" => false,
                    "type" => $type
                ]);
            }

            $worstBattleRequest = $worstBattle->getRequest();

            // Return default Battle History view
            return $this->battleHistory($manager, $worstBattle, $worstBattleRequest, "worst");
        }

        // Render All battle history items
        elseif($type !== "all") {
            // TODO: Get all of user's battle records and sort based on date

            // Return Call
            return $this->render('profile/profile_history_all.html.twig');
        }

        // Render specific Battle History with slug ID
        else {

            $battle = $manager
                ->getRepository(Battle::class)
                ->find($type);

            if(!$battle) {
                // Return Call
                return $this->render('profile/profile_history.html.twig', [
                    "battleRecordExists" => false,
                    "type" => $type
                ]);
            }
            // TODO: validate that battle history viewed is one in which User was a part of

            $battleRequest = $battle->getRequest();

            // Return Call
            return $this->battleHistory($manager, $battle, $battleRequest, "custom");
        }


    }

    /**
     * @Route("/my_profile/achieve",name="app_my-profile-achieve")
     * @Security("has_role('ROLE_USER')")
     */

    // Player's Achievement List
    function profileAchievements() {

        // Return Call
        return $this->render('profile/profile_achieve.html.twig');
    }

    //////////////////////////////
    ///// HELPER METHODS /////////
    //////////////////////////////

    ////////////////////////
    // Returns number to be added to user's current level to represent a level up
    // Use this function to check if User can level up after receiving new XP
    // Usage: 'ProfileController::GetUserNextLevelXP($obj)'
    ////////////////////////
    public static function GetUserNextLevelXP(UserStat $userStatObj) {

        $userLevel = $userStatObj->getUserLevel();
        $userXP = $userStatObj->getExperience();

        $const = 1.3; // Exponential Modifier for Level Scale

        $xpNeededLvl = 0;
        $i = $xpNeededLvl;
        while(true) {
            $xpNeeded = (pow($userLevel + $i, $const)) * 100;
            if($userXP < $xpNeeded) {
                return $xpNeededLvl;
            } else {
                $xpNeededLvl = $i;
                $i++;
            }
        }

        return $xpNeededLvl;
    }

    // Returns string giving player's rank - e.g. 'Bronze II'
    public static function getRankName($rank) {
        if($rank <= 0)
            return "None";

        $rankName = "";
        if($rank >= 1 && $rank < 6)
            $rankName = "Bronze";
        elseif($rank >= 6 && $rank < 11)
            $rankName = "Silver";
        elseif($rank >= 11 && $rank < 16)
            $rankName = "Gold";
        elseif($rank >= 16 && $rank < 21)
            $rankName = "Platinum";
        elseif($rank >= 21 && $rank < 26)
            $rankName = "Diamond";
        elseif($rank >= 26 && $rank < 31)
            $rankName = "Elite";

        $rankLvl = 1;
        $numArray = ["I", "II", "III", "IV", "V"];
        $rankLvlName = $numArray[$rankLvl-1];

        return $rankName . " " . $rankLvlName;
    }

    /**
     * @Route("/level_scale_display",name="app_my-profile-level_scale_display")
     * @Security("has_role('ROLE_USER')")
     */

    // Quick Reference tool
    // Displays list of levels and the experience points needed to acquire them up to 150
    function levelTest() {

        $xpArray = [];
        for($i = 0; $i < 150; $i++) {
            $level = $i;
            $const = 1.3;
            $xpNeeded = (pow($level, $const) * 100 ) . " points needed";
            array_push($xpArray, "$level : $xpNeeded");
        }
        $response = "";
        foreach($xpArray as $line) {
            $response .= $line."<br>";
        }

        return new Response($response);
    }


}