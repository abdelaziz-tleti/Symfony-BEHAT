<?php

namespace App\DataFixtures;


use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // for ($i = 0; $i < 10; $i++) {
        //     $product = new Product();
        //     $product->setPrice(10);
        //     $manager->persist($product);
        // }


        $product = new Product();
        $product->setId(1);
        $product->setPrice(10);
        
        $product2 = new Product();
        $product2->setId(2);
        $product2->setPrice(9);

        $manager->persist($product);
        $manager->persist($product2);



        $manager->flush();
    }
}
