<?php


namespace App\Controllers;


use App\Controller;

class PublicationController extends Controller
{
    public function publicationsList($params = [])
    {
        $sqlParams = [];
        if (isset($params["categoryid"])) {
            $sqlParams["categoryid"] = $params["categoryid"];
        }
        $publications = $this->models["publications"]->getPublicationsByCategory($sqlParams);
        return $this->renderer->render(
            $this->request,
            "publications",
            [
                "title" => "Публикации",
                "publications" => $publications
            ]
        );
    }

    public function publicationAdd()
    {
        $categories = $this -> models["category"] -> getAll();
        return
            $this->renderer->render(
                $this->request,
                "publication-form",
                [
                    "title" => "Добавление публикации",
                    "categories" => $categories
                ]

            );
    }
}