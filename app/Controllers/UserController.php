<?php


namespace App\Controllers;


use App\Controller;

class UserController extends Controller
{
    public function userRegister(){


        return $this -> renderer -> render(
            $this -> request,
            "user-register"
        );
    }

    public function checkUser(){
        $field = key($this -> request -> getGetParams());
        $value = $_GET[$field];
        $res = $this -> models['users'] -> getByField($field,$value);
        if (!empty($res)) return "+";
        return "-";
    }

}