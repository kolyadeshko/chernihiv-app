<?php


namespace App\Controllers;


use App\Controller;
use App\Uploader\ImageUploader;

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

    public function publicationAdd($errorList = '')
    {
        $categories = $this -> models["category"] -> getAll();
        return
            $this->renderer->render(
                $this->request,
                "publication-form",
                [
                    "title" => "Добавление публикации",
                    "categories" => $categories,
                    "errorList" => $errorList
                ]

            );
    }


    public function publicationAddDataProcessing(){
        // данные пост-запроса
        $data = $this -> request -> getPostParams();
        // переданное изображение
        $image = $this -> request -> getFiles()["image"];

        $imageUploader = new ImageUploader($image,MEDIA ."/publications");
        $imageUploader -> validate();
        $errorList = $imageUploader -> getErrorList();
        if ($errorList){
            header("Location:/publication-add");
        }
    }
}