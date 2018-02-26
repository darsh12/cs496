<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 2/25/18
 * Time: 5:57 PM
 */

namespace App\Controller;

use App\Entity\Players;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PlayerController extends AbstractController
{

    /**
     * @Route("/players",name="app_player_index")
     */
    public function index()
    {

        $em=$this->getDoctrine()->getManager();

        $player = new Players();
        $player->setName("WKU");
        $player->setPrice(20000);

        //You do not want to run the query now
        $em->persist($player);

        //You now want to run the query
        $em->flush();

        return $this->render('player/index.html.twig',[
           'controller_name'=>"Player Controller", 'player'=>$player
        ]);
    }

    /**
     * @Route("/players/all",name="app_player_all")
     */
    public function showPlayers()
    {
        $players=$this->getDoctrine()->getRepository(Players::class);

        $player=$players->findAll();

        return $this->render('player/index.html.twig',[
            'controller_name'=>'All Players','player'=>$player
        ]);
    }


}