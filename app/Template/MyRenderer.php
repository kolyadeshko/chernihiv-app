<?php


namespace App\Template;


class MyRenderer implements Renderer
{

    public function render($request,$templateName,$data = [])
    {
        $DATA = json_encode($data);
        ob_start();
        include(__DIR__."\..\..\public\\templates\\base.php");
        $content = ob_get_clean();
        return $content;

    }
}