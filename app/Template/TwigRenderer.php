<?php


namespace App\Template;


use Twig\Environment;

class TwigRenderer implements Renderer
{
    private $renderer;
    public function __construct()
    {
        $this -> renderer = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../public/templates')
        );
    }
    public function render($request,$templateName, $data = [])
    {
        return $this -> renderer ->render($templateName.".html",$data);
    }
}