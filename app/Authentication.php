<?php


namespace App;


class Authentication
{
    protected $session;
    public function __construct()
    {
        $this -> session = $_SESSION;
    }
    public function getSessionData(){
        return $this -> session;
    }
    public function getUser(){
        return "Kolya deshko";
    }
    public function isAuth(){
        return true;
    }
    public function getUserId(){
        return 1;
    }
}