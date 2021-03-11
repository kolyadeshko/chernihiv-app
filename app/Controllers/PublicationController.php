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
        $sqlParams = array_merge($this->request->getGetParams(),$params,['publicated'=>1]);
        $this->getPagination($sqlParams, 5);
        $res = $this->models["publications"]->getPublications($sqlParams);
        $publications = $res['publications'];
        $this -> dateTransform($publications,'created');
        return $this->renderer->render(
            $this->request,
            "publications",
            [
                "publications" => $publications,
                "paginationInfo" => [
                    "count" => $res['pubCount'],
                    "pageCount" => ceil($res['pubCount'] / 5)
                ]
            ]
        );
    }
    private function dateTransform(&$arr,$field){
        foreach ($arr as $k => $v){
            $date = strtotime($v[$field]);
            $arr[$k][$field] = date('d.m.Y',$date);
        }
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
        // получаем запрашиваемую публикацию
        $publication = $this -> models['publications'] -> getDetailPublication($id);
        // добавляем один просмотр к данной записи
        if ($publication){
            $this -> models['publications'] -> addPublicationView($id);
        }
        // проверяем есть ли авторизированный пользователь в списке лайкнувших
        $publication['users_likes'] = json_decode($publication['users_likes']);
        if (in_array(
            $this -> request -> auth -> getUserData()['id'],
            $publication['users_likes']

        )){
            $publication['liked'] = true;
        } else {
            $publication['liked'] = false;
        }
        // убираем с данных о публикации список лайкнувших
        unset($publication['like_users']);

        return $this -> renderer -> render(
            $this -> request,
            "publication-detail",
            [
                "publication" => $publication
            ]
        );
    }
    // функция которая добавляет пользователя в список лайкнувших запись
    // либо удаляет оттуда
    public function changeLike($params){
        $publicationId = $params['publicationId'];
        $userId = $this -> request -> auth -> getUserData()['id'];
        $this -> models['publications'] -> changeLike(
            $userId, $publicationId
        );
    }

}