<?php declare(strict_types = 1);

namespace App;

require '../vendor/autoload.php';


$injector = include "dependencies.php";

$request = $injector -> make("\App\Request");

// FastRoute
// https://github.com/nikic/FastRoute
$dispatcher = \FastRoute\simpleDispatcher(
    function (\FastRoute\RouteCollector $r){
        $routes = include('routes.php');
        foreach ($routes as $value){
            $r -> addRoute(
                $value["method"],
                $value["path"],
                $value["handler"]
            );
        }
    }
);


// dispatch() возвращает массив, первый элемент содержит
// код состояния. Это одно из Dispatcher::NOT_FOUND,
// Dispatcher::METHOD_NOT_ALLOWED и Dispatcher::FOUND

$routeInfo = $dispatcher -> dispatch(
    $request -> getMethod(),
    $request -> getUri()
);
/*
 * routeInfo
 (
    [0] => 1
    [1] => Array
        (
            [className] => Mainpage
            [methodName] => getPage
        )

    [2] => Array
        (
        )

)*/

switch ($routeInfo[0]){
    case \FastRoute\Dispatcher::NOT_FOUND:
        $content = "404 страницу не найдено";
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $content = "Метод не разрешен";
        break;
    case \FastRoute\Dispatcher::FOUND:
        if (in_array("loginRequire",$routeInfo[1])){
            if (!$request -> auth -> isAuth()){
                header("Location:/login");
                die();
            }
        }
        $className = "\App\Controllers\\".$routeInfo[1]["className"];
        $method = $routeInfo[1]["methodName"];
        $vars = $routeInfo[2];
        $obj = $injector ->make($className);
        $content = $obj->$method($vars);
        break;
}

echo($content);