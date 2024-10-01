<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCES = [];

    public function load(ObjectManager $manager): void
    {
        $parentCategory = null;
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName('Category ' . $i);
            $category->setParent($parentCategory);

            $manager->persist($category);

            // Store a reference to use in ProductFixtures
            $this->addReference('category_' . $i, $category);

            $parentCategory = $category;
        }

        $manager->flush();
    }
}
