<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\CharCard;
use App\Entity\UserCharCards;
use App\Entity\UserStat;
use App\Entity\UserUtilCards;
use App\Entity\UtilCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

// Controller for Profile Sub-Tabs
class ProfileController extends AbstractController
{
    /**
     * @Route("/my_profile/stats",name="app_my-profile-stats")
     */
    public function profileStats()
    {
        $userID = $this->getUser()->getId();
        $userName = $this->getUser()->getUsername();

        // User Stat Object w/ current User ID
        $userStatObj = $this->getDoctrine()
            ->getRepository(UserStat::class)
            ->findOneBy(["user" => $userID]);

        // Total Matches Won
        $total = $userStatObj->getMatchesWon() + $userStatObj->getMatchesLost();

        // TODO: insert avatar id into User table and get path from here
        // User Profile Avatar
        $profilePicturePath = "images/temp_profile_pic.png";

        // TODO: set experience bar progress (width w/ bootstrap component) using exp points
        // TODO: add card_defeats field to user_util_cards to track worst performing utility card
        // TODO: add timesDefended field to user_stat

            /////////////////////////////////////////
            ///// Favorite Character Query ////////
            /////////////////////////////////////////

            // Get Favorite Character Card's Id
            $favCharID = $userStatObj->getFavouriteCharCard();

        // If the User has a favorite card, retrieve and render all stats
        // Else Render everything but Favorite/Worst Cards (we'll initialize those after the first battle)
        // TODO: Complete initialization of UserStat record with favorite/worst cards
        if($favCharID) {

            $favCharStatCard = $this->getCharStatCard($favCharID);

            $favUserCharCard = $favCharStatCard['userCharCard'];
            $favCharCard = $favCharStatCard['charCard'];
            $favCharCardImage = $favCharStatCard['charCardImage'];
            /////////////////////////////////////////


            /////////////////////////////////////////
            ///// Favorite Utility Query ////////////
            /////////////////////////////////////////

            // Get Favorite Utility Card's Id
            $favUtilID = $userStatObj->getFavouriteUtilCard();

            $utilStatCard = $this->getUtilStatCard($favUtilID);

            $favUserUtilCard = $utilStatCard['userUtilCard'];
            $favUtilCard = $utilStatCard['utilCard'];
            $favUtilCardImage = $utilStatCard['utilCardImage'];
            $favAttrModArray = $utilStatCard['attrModArray'];
            /////////////////////////////////////////


            /////////////////////////////////////////
            ///// Worst Character Query ////////
            /////////////////////////////////////////

            // Get Worst Character Card's Id
            $worstCharID = $userStatObj->getDefeatedCharCard();

            $worstCharStatCard = $this->getCharStatCard($worstCharID);

            $worstUserCharCard = $worstCharStatCard['userCharCard'];
            $worstCharCard = $worstCharStatCard['charCard'];
            $worstCharCardImage = $worstCharStatCard['charCardImage'];
            /////////////////////////////////////////


            /////////////////////////////////////////
            ///// Worst Utility Query ////////////
            /////////////////////////////////////////

            // Get Favorite Utility Card's Id
            $worstUtilID = $userStatObj->getDefeatedUtilCard();

            $utilStatCard = $this->getUtilStatCard($favUtilID);

            $worstUserUtilCard = $utilStatCard['userUtilCard'];
            $worstUtilCard = $utilStatCard['utilCard'];
            $worstUtilCardImage = $utilStatCard['utilCardImage'];
            $worstAttrModArray = $utilStatCard['attrModArray'];
            /////////////////////////////////////////


            // Return Call
            return $this->render('profile/profile_stats.html.twig',
                [
                    "user_name" => $userName,
                    "user_stat" => $userStatObj,
                    // TODO: Calculate level progress based on current level and current XP
                    "level_progress" => 10,
                    "total_matches" => $total,
                    "profile_pic" => $profilePicturePath,

                    "fav_char_img" => $favCharCardImage,
                    "fav_util_img" => $favUtilCardImage,
                    "worst_char_img" => $worstCharCardImage,
                    "worst_util_img" => $worstUtilCardImage,

                    "fav_char" => $favCharCard,
                    "fav_util" => $favUtilCard,
                    "worst_char" => $worstCharCard,
                    "worst_util" => $worstUtilCard,

                    "fav_attr_mod" => $favAttrModArray,
                    "worst_attr_mod" => $worstAttrModArray,
                    "fav_user_char_card" => $favUserCharCard,
                    "fav_user_util_card" => $favUserUtilCard,
                    "worst_user_char_card" => $worstUserCharCard,
                    "worst_user_util_card" => $worstUserUtilCard,
                    "render_card_stats" => true
                ]);
        } else {

            // Return Call
            return $this->render('profile/profile_stats.html.twig',
                [
                    "user_name" => $userName,
                    "user_stat" => $userStatObj,
                    // TODO: Calculate level progress based on current level and current XP
                    "level_progress" => 10,
                    "total_matches" => $total,
                    "profile_pic" => $profilePicturePath,
                    "render_card_stats" => false
                ]);
        }
    }

    /**
     * @Route("/my_profile/edit",name="app_my-profile-edit")
     */
    public function editProfile()
    {
        $userName = $this->getUser()->getUsername();

        // TODO: insert avatar id into User table and get path from here
        // User Profile Avatar
        $profilePicturePath = "images/temp_profile_pic.png";

        // Return Call
        return $this->render('profile/profile_edit.html.twig',
            [
                "user_name" => $userName,
                "profile_pic" => $profilePicturePath,
            ]);
    }

    // Returns Array of Objects & Values
    // Representing Player's Favorite/Worst Character Card
    protected function getCharStatCard($charCardId) {
        $charStatCard = [];

        $userCharCard = $this->getDoctrine()
            ->getRepository(UserCharCards::class)
            ->find($charCardId);
        $charStatCard['userCharCard'] = $userCharCard;

        // Get Character Card's ID from User<->Card Relation
        $charCardID = $userCharCard->getCharCard();

        // Get Character Card Object
        $charStatCard['charCard'] = $this->getDoctrine()
            ->getRepository(CharCard::class)
            ->find($charCardID);

        $charAvatarID = $charStatCard['charCard']->getAvatar();
        $charAvatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->find($charAvatarID);

        $charStatCard['charCardImage'] = $charAvatar->getImagePath();

        return $charStatCard;

    }

    // Returns Array of Objects & Values
    // Representing Player's Favorite/Worst Utility Card
    protected function getUtilStatCard($utilCardId) {

        $utilStatCard = [];

        // Get User<->Card Object for given ID
        $userUtilCard = $this->getDoctrine()
            ->getRepository(UserUtilCards::class)
            ->find($utilCardId);
        $utilStatCard['userUtilCard'] = $userUtilCard;

        // Get Utility Card's ID from User<->Card Relation
        $utilCardID = $userUtilCard->getUtilCard();

        // Get Utility Card Object
        $utilStatCard['utilCard'] = $this->getDoctrine()
            ->getRepository(UtilCard::class)
            ->find($utilCardID);

        $utilAvatarID = $utilStatCard['utilCard']->getAvatar();
        $utilAvatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->find($utilAvatarID);

        $utilStatCard['utilCardImage'] = $utilAvatar->getImagePath();

        $jsonAttributeString = $utilStatCard['utilCard']->getAttributeModifier();
        $utilStatCard['attrModArray'] = json_decode($jsonAttributeString);

        return $utilStatCard;
    }
}