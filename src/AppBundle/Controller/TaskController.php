<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 15:45.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    private function getTaskManager()
    {
        return $this->container->get('app.task_manager');
    }

    private function getCategoryManager()
    {
        return $this->container->get('app.category_manager');
    }

    /**
     * @Route("/", name="app_task_list")
     */
    public function listAction()
    {
        $categoryManager = $this->getCategoryManager();
        $categories = $categoryManager->getCategory();
        $taskManager = $this->getTaskManager();
//        $taskByCategory = $categories->getTasks();
        $tasks = $taskManager->getTask();

        return $this->render(':tasks:list.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/task/new", name="app_task_new", methods={"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $taskManager = $this->getTaskManager();

        $newTask = $taskManager->create();
        $form = $this->createForm(TaskType::class, $newTask);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskManager->save($newTask);

            $this->addFlash(
                'success',
                'votre tache a été créé'
            );

            return $this->redirectToRoute('app_task_list');
        }

        return $this->render(':tasks:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/task/edit/{id}", name="app_task_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Task $task)
    {
        $taskManager = $this->getTaskManager();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskManager->save($task);

            $this->addFlash(
                'success',
                'votre tache a été modifié'
            );

            return $this->redirectToRoute('app_task_list');
        }

        return $this->render(':tasks:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
