<?php

namespace App;

class Request
{
    private $requestMethod;
    private $requestUri;
    private $cookies;
    public $auth;

    public function __construct(Authentication $authentication)
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this -> auth = $authentication;
    }

    public function getUri()
    {
        // находим позицию символа ? в uri
        // если такого символа нет - вернется false
        $requestUri = $this->requestUri;
        $pos = strpos($requestUri, "?");
        if ($pos !== false) {
            $requestUri = substr($requestUri, 0, $pos);
        }
        $requestUri = rawurldecode($requestUri);
        return $requestUri;
    }

    public function getMethod()
    {
        return $this->requestMethod;
    }
    public function getPostParams(){
        return $_POST;
    }
    public function getGetParams(){
        return $_GET;
    }
    public function getFiles(){
        return $_FILES;
    }

}