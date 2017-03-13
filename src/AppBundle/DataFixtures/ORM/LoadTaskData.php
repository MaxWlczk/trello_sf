<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 14:29
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $descriptions = [
            [
                'name' => 'name1',
                'description' => 'task one',
                'category' => $this->getReference('category-0'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name2',
                'description' => 'task two',
                'category' => $this->getReference('category-0'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name3',
                'description' => 'task three',
                'category' => $this->getReference('category-1'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name4',
                'description' => 'task four',
                'category' => $this->getReference('category-1'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name5',
                'description' => 'task five',
                'category' => $this->getReference('category-2'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name6',
                'description' => 'task six',
                'category' => $this->getReference('category-2'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name7',
                'description' => 'task seven',
                'category' => $this->getReference('category-3'),
                'status' => Task::STATUS_OPEN,
            ],
            [
                'name' => 'name8',
                'description' => 'task eight',
                'category' => $this->getReference('category-3'),
                'status' => Task::STATUS_OPEN,
            ],
        ];

        foreach ($descriptions as $i => $description){
            $oneTask = new Task();
            $oneTask->setDescription($description['description']);
            $oneTask->setName($description['name']);
            $oneTask->setCategory($description['category']);
            $oneTask->setStatus($description['status']);
            $manager->persist($oneTask);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}