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

class DynamicController extends AbstractController
{

    /**
     * @Route("/my_profile",name="app_my-profile")
     */
    public function myProfile()
    {
        $userName = $this->getUser()->getUserName();
        return $this->render('tabs/my_profile.html.twig', ["username" => $userName]);
    }


    /**
     * @Route("/inventory",name="app_inventory")
     */
    public function inventory()
    {
        return $this->render('tabs/inventory.html.twig');
    }

    /**
     * @Route("/battle",name="app_battle")
     */
    public function battle()
    {
        return $this->render('tabs/battle.html.twig');
    }

    /**
     * @Route("/market",name="app_market")
     */
    public function market()
    {
        return $this->render('tabs/market.html.twig');
    }


}