<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:47
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function getCategory(){
        return $this->getRepository()->getCategory();
    }

    private function getRepository(){
        return $this->entityManager->getRepository(Category::class);
    }
}