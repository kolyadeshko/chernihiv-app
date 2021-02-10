<?php


namespace App\Controllers;


use App\Controller;
use App\Session;
use App\Validators\UserValidator;

class UserController extends Controller
{
    public function userRegister(){

        $serverErrors = $this -> getServerErrors();
        return $this -> renderer -> render(
            $this -> request,
            "user-register",
            [
                "serverErrors" => $serverErrors
            ]
        );
    }
    private function getServerErrors(){
        return $this -> session -> getSessionByKey(
            'serverErrors',
            Session::$UNSET_AFTER_GET_KEY
        );

    }

    public function checkUser(){
        $getParams = $this -> request -> getGetParams();
        $field = key($getParams);
        $value = $getParams[$field];
        $res = $this -> models['users'] -> getByField($field,$value);
        if (!empty($res)) return "+";
        return "-";
    }

    public function registerDataProcessing(){
        $registerData = $this -> request -> getPostParams();
        if (empty($registerData)) header("Location:/");
        $validator = new UserValidator(
            $registerData,
            $this -> models['users']
        );
        if (!($validator -> isValid())){
            $errorList = $validator -> getErrorList();
            $this -> session ->setSessionKey(
                "serverErrors",
                $errorList
            );
            return header("Location:/register");
        }
        $registerData['password'] = $this -> getHashPassword(
            $registerData['password']
        );
        $this -> models['users'] -> registerUser($registerData);
        $this -> session -> setSessionKey(
            "successRegister",
            $registerData
        );
        return header("Location:/register-answer");
    }
    public function registerAnswer(){
        $answer = $this -> session -> getSessionByKey(
            "successRegister",
            Session::$UNSET_AFTER_GET_KEY
        );
        if (!$answer) header("Location:/");
        return $this -> renderer -> render(
            $this -> request,
            "register-answer",
            [
                'answer' => $answer
            ]
        );

    }

    private function getHashPassword($password){
        return md5($password);
    }

}