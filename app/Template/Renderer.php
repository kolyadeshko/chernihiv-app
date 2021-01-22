<?php


namespace App\Template;


interface Renderer
{
    public function render($request,$templateName,$data=[]);
}