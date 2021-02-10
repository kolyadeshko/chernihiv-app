<?php


namespace App\Controllers;


use App\Controller;
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
        $serverErrors = $this -> session -> getSessionByKey('serverErrors');
        $this -> session -> unsetSession(['serverErrors']);
        return $serverErrors;
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
        $validator = new UserValidator(
            $registerData,
            $this -> models['users']
        );
        if (!($validator -> isValid())){
            $errorList = $validator -> getErrorList();
            session_start();
            $_SESSION['serverErrors'] = $errorList;
            header("Location:/register");
        }
        return "Все норм";
    }

}