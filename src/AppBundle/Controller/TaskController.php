<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:45
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TaskController extends Controller
{

    private function getTaskManager(){
        return $this->container->get('app.task_manager');
    }

    private function getCategoryManager(){
        return $this->container->get('app.category_manager');
    }

    /**
     * @Route("/", name="app_task_list")
     */
    public function listAction(){
        $categoryManager = $this->getCategoryManager();
        $categories = $categoryManager->getCategory();
        $taskManager = $this->getTaskManager();
//        $taskByCategory = $categories->getTasks();
        $tasks = $taskManager->getTask();

        return $this->render(':tasks:list.html.twig', [
            'categories' => $categories,
        ]);
    }

}