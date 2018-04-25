<?php

namespace App\Controller;

use App\Entity\Avatar;
use App\Form\UserAvatarType;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Form\Type\ChangePasswordFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


// Controller for Profile Sub-Tabs
class ProfileController extends Controller
// my_profile/edit
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

        // TODO: Create Change Password Form

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


}