<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Entity\BattleRequest;
use App\Entity\CharCard;
use App\Entity\UserCharCards;
use App\Entity\UserStat;
use App\Entity\UserUtilCards;
use App\Entity\UtilCard;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DynamicController extends Controller
{

    protected $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/my_profile",name="app_my-profile")
     * @Security("has_role('ROLE_USER')")
     */
    public function myProfile()
    {
        if(!$this->getUser())
            return $this->render('homepage.html.twig');

        // Create record for user's empty stats upon registration
        $this->initializeProfile();

        $avatarDirectory = $this->getParameter('avatar_directory');


        $user = $this->getUser();
        $userID = $user->getId();
        $userName = $user->getUsername();

        // User Stat Object w/ current User ID
        $userStatObj = $this->getDoctrine()
            ->getRepository(UserStat::class)
            ->findOneBy(["user" => $userID]);

        // Total Matches Won
        $total = $userStatObj->getMatchesWon() + $userStatObj->getMatchesLost();

        // User Profile Avatar
        $userAvatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->find($user->getAvatar());

        $profilePicturePath = $avatarDirectory.'/'.$userAvatar->getImagePath();

        // Calculate User's progress based on their current level and XP held
        $xpNeeded = ProfileController::GetUserNextLevelXP($userStatObj);
        $xpHeld = $userStatObj->getExperience();
        $userProgressionExperience = ($xpHeld / $xpNeeded) * 100;

        // Get User's Rank display
        $userRank = ProfileController::getRankName($userStatObj->getUserRank());

        //////////////////////////////////////
        ///// Favorite Character Query ///////
        //////////////////////////////////////

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


            /////////////////////////////////////
            ///// Favorite Utility Query ////////
            /////////////////////////////////////

            // Get Favorite Utility Card's Id
            $favUtilID = $userStatObj->getFavouriteUtilCard();

            $utilStatCard = $this->getUtilStatCard($favUtilID);

            $favUserUtilCard = $utilStatCard['userUtilCard'];
            $favUtilCard = $utilStatCard['utilCard'];
            $favUtilCardImage = $utilStatCard['utilCardImage'];
            $favAttrModArray = $utilStatCard['attrModArray'];
            /////////////////////////////////////////


            ////////////////////////////////////
            ///// Worst Character Query ////////
            ////////////////////////////////////

            // Get Worst Character Card's Id
            $worstCharID = $userStatObj->getDefeatedCharCard();

            $worstCharStatCard = $this->getCharStatCard($worstCharID);

            $worstUserCharCard = $worstCharStatCard['userCharCard'];
            $worstCharCard = $worstCharStatCard['charCard'];
            $worstCharCardImage = $worstCharStatCard['charCardImage'];
            /////////////////////////////////////////


            //////////////////////////////////////
            ///// Worst Utility Query ////////////
            //////////////////////////////////////

            // Get Favorite Utility Card's Id
            $worstUtilID = $userStatObj->getDefeatedUtilCard();

            $utilStatCard = $this->getUtilStatCard($worstUtilID);

            $worstUserUtilCard = $utilStatCard['userUtilCard'];
            $worstUtilCard = $utilStatCard['utilCard'];
            $worstUtilCardImage = $utilStatCard['utilCardImage'];
            $worstAttrModArray = $utilStatCard['attrModArray'];
            /////////////////////////////////////////


            // Return Call
            return $this->render('tabs/my_profile.html.twig',
                [
                    "user_name" => $userName,
                    "user_stat" => $userStatObj,
                    "user_rank" => $userRank,
                    "level_progress" => $userProgressionExperience,
                    "xp_needed" => $xpNeeded,
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
            return $this->render('tabs/my_profile.html.twig',
                [
                    "user_name" => $userName,
                    "user_rank" => $userRank,
                    "user_stat" => $userStatObj,
                    "level_progress" => $userProgressionExperience,
                    "xp_needed" => $xpNeeded,
                    "total_matches" => $total,
                    "profile_pic" => $profilePicturePath,
                    "render_card_stats" => false
                ]);
        }

    }


    /**
     * @Route("/inven",name="app_intory")
     * @Security("has_role('ROLE_USER')")
     */
    public function inventory()
    {
        return $this->render('tabs/inventory.html.twig');
    }

    /**
     * @Route("/battle",name="app_battle")
     * @Security("has_role('ROLE_USER')")
     */
    public function battle(ObjectManager $manager)
    {
        $user = $this->getUser();
        $userRepo = $manager->getRepository(UserStat::class)->findOneBy(['user' => $user]);
        $otherUserStats = $manager->getRepository(UserStat::class)->ExceptCurrentUser($user);
        $sentBattles = $manager->getRepository(BattleRequest::class)->getDefenderStat($user);
        $receivedBattles = $manager->getRepository(BattleRequest::class)->getAttackerStat($user);


        return $this->render('tabs/battle.html.twig', ["otherUserStats" => $otherUserStats, 'sentBattles' => $sentBattles, 'receivedBattles' => $receivedBattles, 'userStats' => $userRepo]);
    }

    /**
     * @Route("/market",name="app_market")
     * @Security("has_role('ROLE_USER')")
     */
    public function market()
    {
        return $this->render('tabs/market.html.twig');
    }


    //////////////////////////////
    ///// HELPER METHODS /////////
    //////////////////////////////


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

    // Create empty stats record for user if it doesn't exist already
    protected function initializeProfile() {
        $user = $this->getUser();

        $userStatObj = $this->entityManager->getRepository(UserStat::class)->findBy(["user" => $user]);


        //If record doesn't exist
        if (!$userStatObj) {
            $entityManager = $this->getDoctrine()->getManager();

            //Insert the new cards

            $this->get(FirstCardsController::class)->newCards($user);

            $userStatObj = new UserStat();
            $userStatObj->setUser($user);
            $userStatObj->setUserLevel(1);
            $userStatObj->setUserRank(1);

            $entityManager->persist($userStatObj);
            $entityManager->flush();
            $this->addFlash('success', 'You have received free cards for registering an account! Check your inventory for details.');
        }

        // Initialize Default Avatar Reference if User has none
        $userAvatar = $user->getAvatar();

        if(!$userAvatar) {
            $defaultAvatar = $entityManager
                ->getRepository(Avatar::class)
                ->find(15); // Default Avatar's ID = 15

            $user->setAvatar($defaultAvatar);
            $entityManager->flush();
        }

        return new Response(null, 204);
    }

}