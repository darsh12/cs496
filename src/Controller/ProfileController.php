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
use App\Form\UserAvatarType;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


// Controller for Profile Sub-Tabs
class ProfileController extends Controller
{
    /**
     * @Route("/my_profile/stats",name="app_my-profile-stats")
     * @Security("has_role('ROLE_USER')")
     */
    public function profileStats()
    {
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


        // TODO: set experience bar progress (width w/ bootstrap component) using exp points

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
     * @Security("has_role('ROLE_USER')")
     */
    public function editProfile()
    {
        $avatarDirectory = $this->getParameter('avatar_directory');

        $user = $this->getUser();
        $userName = $user->getUsername();

        // User Profile Avatar
        $userAvatar = $this->getDoctrine()
            ->getRepository(Avatar::class)
            ->find($user->getAvatar());

        $profilePicturePath = $avatarDirectory.'/'.$userAvatar->getImagePath();

        // Return Call
        return $this->render('profile/profile_edit.html.twig',
            [
                "user_name" => $userName,
                "profile_pic" => $profilePicturePath,
            ]);
    }



    public function updateUserAvatar()
    {
        // Get File's Source Path/Name
        $sourcePath = $_FILES['img_input']['tmp_name'];

        // Check if file size is too big
        $fileSize = filesize($sourcePath);
        if($fileSize >= 1000000000) {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Image Too Large",
                "notify_msg" => "File selected is too large to upload. File must be less than 1GB in size<br>File Size: $fileSize"
            ]);
        }

        // Create image from sourcePath if image's MIME type is valid
        $imgExt = $this->getValidImageMime($sourcePath);

        $image = "";
        if ($imgExt == 'jpg')
            $image = imagecreatefromjpeg($sourcePath);
        elseif ($imgExt == 'png')
            $image = imagecreatefrompng($sourcePath);

        // Path to save image on server
        $serverFilePath = "images/avatars/".time().".$imgExt";

        // If image and its MIME type are valid, save the image file
        if($imgExt !== false && $image !== "") {

            // Reduce size of created Image and Save to server path
            imagejpeg($image, $serverFilePath, 60);

            // Check if User has avatar record
            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $userAvatar = $entityManager
                ->getRepository(Avatar::class)
                ->find($user->getAvatar());

            // If user has doesn't have default avatar, delete old image & update image path
            if($userAvatar->getImagePath() !== "images/default.jpg") {
                // Delete file
                unlink($userAvatar->getImagePath());
                // Update path
                $userAvatar->setImagePath($serverFilePath);
                // Execute update
                $entityManager->flush();
            }
            // Else create new Avatar record & update avatar reference
            else {
                // Create new Avatar
                $newAvatar = new Avatar();
                $newAvatar->setImagePath($serverFilePath);

                $entityManager->persist($newAvatar);
                $entityManager->flush();

                // Update Avatar reference
                $newAvatar = $entityManager
                    ->getRepository(Avatar::class)
                    ->findOneBy(["image_path" => $serverFilePath]);
                $user->setAvatar($newAvatar);
                $entityManager->flush();
            }

        } else {
            return $this->render("notification.html.twig", [
                "notify_color" => "red",
                "notify_title" => "Invalid File Type",
                "notify_msg" => "File chosen for upload is not an image"
                ]);
        }

        return $this->render("notification.html.twig", [
            "notify_color" => "#07ac14",
            "notify_title" => "Profile Update Successful",
            "notify_msg" => "Your profile picture has been successfully changed."
        ]);
    }


    /**
     * @Route("/my_profile/avatar_upload",name="app_my-profile-avatar-upload")
     */

    public function uploadAvatar(Request $request, FileUploader $fileUploader, ObjectManager $manager)
    {
        $user=$this->getUser();
        $avatar =  new Avatar();
        $form=$this->createForm(UserAvatarType::class, $avatar);
        $form->handleRequest($request);

        $oldUserAvatar=$user->getAvatar()->getImagePath();
        $oldAvatar = $manager->getRepository(Avatar::class)->findOneBy(['image_path'=>$oldUserAvatar]);

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

            $this->addFlash('success', 'Image uploaded');
        }

        return $this->render('test.html.twig', ['avatarForm'=>$form->createView()]);

    }



    //////////////////////////////
    ///// HELPER METHODS /////////
    //////////////////////////////

    // If uploaded file has an image MIME type, return the type; Else return false
    function getValidImageMime($filePathName ) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file( $finfo, $filePathName );
        finfo_close( $finfo );

        if($mtype == "image/png") {
            return "png";
        }
        elseif($mtype == "image/jpeg") {
            return "jpg";
        }
        else {
            return FALSE;
        }
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