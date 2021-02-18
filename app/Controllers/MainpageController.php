<?php


namespace App\Controllers;


class MainpageController extends \App\Controller
{
    public function getMainpage(){
        return $this -> renderer -> render(
            $this -> request,
            "mainpage"
        );
    }
}