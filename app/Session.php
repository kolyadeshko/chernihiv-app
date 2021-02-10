<?php


namespace App;


class Session
{

    public static $UNSET_AFTER_GET_KEY = 1;

    public function __construct()
    {
        session_start();
    }

    public function getSessionByKey($key,$unsetAfterGet = 0){
        $value = $_SESSION[$key];
        if (isset($value)){
            if ($unsetAfterGet === self::$UNSET_AFTER_GET_KEY) $this->unsetSession([$key]);
            return $value;
        }
        return false;
    }
    public function getSessionData(){
        return $_SESSION;
    }

    public function setSessionKey($key,$value){
        $_SESSION[$key] = $value;
    }
    public function unsetSession($keys = []){
        if (empty($keys)){
            session_unset();
        } else {
            foreach ($keys as $key){
                unset($_SESSION[$key]);
            }
        }
    }
}

