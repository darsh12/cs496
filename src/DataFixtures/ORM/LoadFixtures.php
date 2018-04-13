<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 4/13/18
 * Time: 7:09 AM
 */

namespace App\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;


class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
        foreach($objectSet as $object) {
            $manager->persist($object);
        }
        $manager->flush();

    }
}