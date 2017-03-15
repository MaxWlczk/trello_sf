<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:47.
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function create()
    {
        return new Category();
    }

    public function getCategory()
    {
        return $this->getRepository()->getCategory();
    }

    private function getRepository()
    {
        return $this->entityManager->getRepository(Category::class);
    }

    public function save(Category $category)
    {
        if (null === $category->getId()) {
            $this->entityManager->persist($category);
        }
        $this->entityManager->flush();
    }

    public function delete(Category $category)
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }
}
