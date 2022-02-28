<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user1= new User();
        $user1->setBirthdate(\DateTime::createFromFormat("d/m/Y H:i", "24/03/1987 16:30"));
        $user1->setEmail('Mail@mail.fr');
        $user1->setPassword("toto");


        $manager->persist($user1);
        $manager->flush();
    }
}
