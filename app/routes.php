<?php declare(strict_types = 1);
$routes = [
    [
        "method" => 'GET',
        "path" => "/[mainpage]",
        "handler" => [
            "className" => "Mainpage",
            "methodName" => "getPage"
            ],
        "description" => "Главная страница сайта"
    ],
    [
        "method" => 'GET',
        "path" => "/publications[/category={categoryid:\d+}]",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationsList"
        ],
        "description" => "Список фотографий"
    ],
    [
        "method" => 'GET',
        "path" => "/categories",
        "handler" => [
            "className" => "CategoryController",
            "methodName" => "getCategoryList"
        ],
        "description" => "Список категорий"
    ],
    [
        "method" => 'GET',
        "path" => "/publication-add",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationAdd"
        ],
        "description" => "Форма добавления публикации"
    ],

];

return $routes;