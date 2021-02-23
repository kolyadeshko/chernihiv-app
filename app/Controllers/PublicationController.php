<?php


namespace App\Controllers;


use App\Controller;
use App\Paginator;
use App\Session;
use App\Uploader\ImageUploader;

class PublicationController extends Controller
{

    public function publicationsList($params = [])
    {
        $sqlParams = array_merge($this->request->getGetParams(),$params);
        $this->getPagination($sqlParams, 5);
        $res = $this->models["publications"]->getPublications($sqlParams);
        return $this->renderer->render(
            $this->request,
            "publications",
            [
                "publications" => $res['publications'],
                "paginationInfo" => [
                    "count" => $res['pubCount'],
                    "pageCount" => ceil($res['pubCount'] / 5)
                ]
            ]
        );
    }

    public function publicationAdd($errorList = '')
    {
        return
            $this->renderer->render(
                $this->request,
                "publication-form"
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
        $this->session->setSessionKey("answer", $answer);
        header("Location:/publication-add-answer");

    }

    public function publicationAddAnswer()
    {
        $answerData = $this->session->getSessionByKey("answer", Session::$UNSET_AFTER_GET_KEY);
        if (!$answerData) header("Location:/");
        return $this->renderer->render(
            $this->request,
            "publication-add-answer",
            [
                "answerData" => $answerData
            ]
        );
    }


    public function publicationDetail($params){
        $id = $params['id'];
        $publication = $this -> models['publications'] -> getDetailPublication($id);
        return $this -> renderer -> render(
            $this -> request,
            "publication-detail",
            [
                "publication" => $publication
            ]
        );
    }
}