<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:47.
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function create()
    {
        return new Task();
    }

    public function getTask()
    {
        return $this->getRepository()->getTasks();
    }

    private function getRepository()
    {
        return $this->entityManager->getRepository(Task::class);
    }

    public function save(Task $task)
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
