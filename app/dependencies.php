<?php


$injector = new \Auryn\Injector();


$injector -> alias("App\Template\Renderer","App\Template\MyRenderer");
$injector->share("App\Template\MyRenderer");

return $injector;