<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 14:29.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            'To do',
            'In progress',
            'Finish',
            'Bugs/comeback',
        ];

        foreach ($categories as $i => $category) {
            $oneCategory = new Category();
            $oneCategory->setName($category);
            $manager->persist($oneCategory);
            $this->addReference('category-'.$i, $oneCategory);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}
