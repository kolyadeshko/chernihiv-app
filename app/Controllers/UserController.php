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

}