<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FOSRest\Route(path="/api/categories")
 */
class CategoryApiController extends FOSRestController
{
    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Récupération de toutes les catégories"
     * )
     *
     * @return Category[]
     *
     * @FOSRest\Get("/")
     * @FOSRest\View()
     */
    public function cgetCategory()
    {
        return $this->getCategoryManager()->getCategory();
    }

    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Récupération d'une catégorie en fonction de son identifiant",
     *  output="AppBundle\Entity\Category"
     * )
     *
     * @return Category
     *
     * @FOSRest\Get("/{id}")
     * @FOSRest\View()
     */
    public function getCategory(Category $category)
    {
        return $category;
    }

    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Création nouvelle catégorie",
     *  input="AppBundle\Form\CategoryType",
     *  output="AppBundle\Entity\Category"
     * )
     *
     * @return Form|Category
     *
     * @FOSRest\Post("/")
     * @FOSRest\View(StatusCode=201)
     */
    public function postCategory(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', CategoryType::class, $this->getCategoryManager()->create(), [
            'csrf_protection' => false,
        ]);
        $taskManager = $this->getCategoryManager();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskManager->save($form->getData());
            // ... save
            return $form->getData();
        }

        return new View($form, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Profile.
     *
     * @ApiDoc(
     *  section="Categories",
     *  description="Suppression d'une catégorie",
     *  output="AppBundle\Entity\Category"
     * )
     *
     * @return Category
     *
     * @FOSRest\Delete("/{id}")
     * @FOSRest\View(StatusCode=200)
     */
    public function deleteCategory(Category $category)
    {
        $this->getCategoryManager()->delete($category);
    }

    private function getCategoryManager()
    {
        return $this->container->get('app.category_manager');
    }
}
