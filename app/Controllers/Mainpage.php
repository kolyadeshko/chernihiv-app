<?php

namespace App\Controllers;
use App\Controller;
use App\Models\Category;
use App\Models\Publications;
use App\Request;
use App\Template\Renderer;

class Mainpage extends Controller
{

    public function getPage(){
        return $this -> renderer -> render($this->request,'mainpage',["request"=>$this->request,"name" => "Kolya"]);
    }
}