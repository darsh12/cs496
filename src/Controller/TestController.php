<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TestTable;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        $em=$this->getDoctrine()->getManager();

        $test=new TestTable();

        $test->setName("bowser");
        $test->setCardHp("88");
        $test->setCardImage("dsfds");

        $em->persist($test);
        $em->flush();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/test/all/")
     */
    public function seeAll()
    {

        $em=$this->getDoctrine()->getRepository(TestTable::class);
        $allName=$em->findAll();

        return $this->render("test/index.html.twig",[
            "controller_name"=>"Test Table", "test"=>$allName
        ]);

    }
}
