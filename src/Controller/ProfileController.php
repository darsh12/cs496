<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/22/18
 * Time: 7:33 PM
 */

namespace App\Controller;

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
        return $this->render('profile/profile_stats.html.twig');
    }
}