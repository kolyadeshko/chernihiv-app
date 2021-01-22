<?php


namespace App\Template;


class MyRenderer implements Renderer
{

    public function render($request,$templateName,$data = [])
    {
        extract($data,EXTR_SKIP);
        ob_start();
        include(__DIR__."\..\..\public\\templates\\base.php");
        $content = ob_get_clean();
        return $content;

    }
}