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
        $taskManager = $this->getTaskManager();
        $tasks = $taskManager->getTask();

        return $this->render(':tasks:list.html.twig', [
            'tasks' => $tasks,
        ]);
    }

}