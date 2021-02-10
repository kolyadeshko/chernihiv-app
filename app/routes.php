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
    [
        "method" => "POST",
        "path" => "/publication-add-data-processing",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationAddDataProcessing"
        ],
        "description" => "Функция которая обрабатывает данные с формы публикации"
    ],
    [
        "method" => 'GET',
        "path" => "/publication-add-answer",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationAddAnswer"
        ],
        "description" => "Ответ после отправки формы публикации"
    ],

    [
        "method" => "GET",
        "path" => "/register",
        "handler" => [
            "className" => "UserController",
            "methodName" => "userRegister"
        ],
        "description" => "Форма регистрации"
    ],
    [
        "method" => "GET",
        "path" => "/get-category-list",
        "handler" => [
            "className" => "CategoryController",
            "methodName" => "categoriesForPublicationAdd"
        ],
        "description" => "Асинхронный запрос списка публикаций для формы добавления публикации"
    ],
    [
        "method" => "GET",
        "path" => "/check-user-register",
        "handler" => [
            "className" => "UserController",
            "methodName" => "checkUser"
        ],
        "description" => "Асинхронная проверка данного значения по данному полю в таблице users в базе данных"
    ],
    [
        "method" => "POST",
        "path" => "/register-data-processing",
        "handler" => [
            "className" => "UserController",
            "methodName" => "registerDataProcessing"
        ],
        "description" => "Функция которая обрабатывает данные с формы регистрации"
    ]
];

return $routes;