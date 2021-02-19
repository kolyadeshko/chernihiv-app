<?php


namespace App;


class Authentication
{
    protected $session;
    private $userData;
    public function __construct(Session $session)
    {
        $this -> session = $session;
        $this -> userData = $this -> session -> getSessionByKey("authUser");
    }
    public function getUserData(){
        $allowedUserData = $this -> userData;
        unset($allowedUserData['password']);
        return $allowedUserData;
    }
    public function logoutUser(){
        $this -> session -> unsetSession(["authUser"]);
    }
    public function isAuth(){
        if ($this -> userData){
            return true;
        }
        return false;
    }

}