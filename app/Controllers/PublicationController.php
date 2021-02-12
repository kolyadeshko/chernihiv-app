<?php


namespace App\Controllers;


use App\Controller;
use App\Session;
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
        $categories = $this->models["category"]->getAll();
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


    public function publicationAddDataProcessing()
    {
        // данные пост-запроса
        $postParams = $this->request->getPostParams();
        // переданное изображение
        $image = $this->request->getFiles()["image"];

        $imageUploader = new ImageUploader($image, "media/publications");
        $imageUploader->validate();
        $errorList = $imageUploader->getErrorList();
        if ($errorList) {
            $answer = [
                "isValid" => false,
                "answerData" => $errorList
            ];
        } else {
            $data = array_merge(
                $postParams,
                [
                    "photo" => "/publications/{$imageUploader->getImageName()}",
                    "userid" => $this->request->auth->getUserData()['id']
                ]
            );
            $imageUploader->upload();
            $this->models['publications']->insertPublication($data);
            $answer = [
                "isValid" => true,
                "answerData" => $data
            ];
        }
        $this -> session -> setSessionKey("answer", $answer);
        header("Location:/publication-add-answer");

    }

    public function publicationAddAnswer()
    {
        $answerData = $this -> session -> getSessionByKey("answer",Session::$UNSET_AFTER_GET_KEY);
        if (!$answerData) header("Location:/");
        return $this->renderer->render(
            $this->request,
            "publication-add-answer",
            [
                "answerData" => $answerData
            ]
        );
    }


}