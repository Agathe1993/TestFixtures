<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private ObjectManager $manager;
    private Generator $generator;

    public function __construct()
    {
        $this->generator = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       $this->manager = $manager;

        $this->addArticle();
    }

    public function addArticle(){

        for($i = 0; $i < 50 ; $i++){

            $article = new Article();
            $article->setDateCreated($this->generator->dateTimeBetween("-2 month", "+1 month"))
                    ->setName("nom".$i)
                    ->setPrice($i);
            $this->manager->persist($article);
        }
        $this->manager->flush($article);
    }
}
