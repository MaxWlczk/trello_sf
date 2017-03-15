<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FOSRest\Route(path="/api/tasks")
 */
class TaskApiController extends FOSRestController
{
    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Tasks",
     *  description="Récupération de toutes les taches"
     * )
     *
     * @return Task
     *
     * @FOSRest\Get("/")
     * @FOSRest\View()
     */
    public function cgetTasks()
    {
        return $this->getTaskManager()->getTask();
    }

    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Tasks",
     *  description="Récupération d'une tache en fonction de son identifiant",
     *  output="AppBundle\Entity\Task"
     * )
     *
     * @return Task
     *
     * @FOSRest\Get("/{id}")
     * @FOSRest\View()
     */
    public function getTask(Task $task)
    {
        return $task;
    }

    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Tasks",
     *  description="Création nouvelle tache",
     *  input="AppBundle\Form\TaskType",
     *  output="AppBundle\Entity\Task"
     * )
     *
     * @return Form|Task
     *
     * @FOSRest\Post("/")
     * @FOSRest\View(StatusCode=201)
     */
    public function postTask(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', TaskType::class, $this->getTaskManager()->create(), [
            'csrf_protection' => false,
        ]);
        $taskManager = $this->getTaskManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskManager->save($form->getData());
            // ... save
            return $form->getData();
        }

        return new View($form, Response::HTTP_BAD_REQUEST);
    }

    private function getTaskManager()
    {
        return $this->container->get('app.task_manager');
    }
}
