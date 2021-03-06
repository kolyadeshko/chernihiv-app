<?php declare(strict_types=1);
$routes = [
    [
        "method" => 'GET',
        "path" => "/[mainpage]",
        "handler" => [
            "className" => "MainpageController",
            "methodName" => "getMainpage"
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
            "methodName" => "publicationAdd",
            "loginRequire"
        ],
        "description" => "Форма добавления публикации"
    ],
    [
        "method" => "POST",
        "path" => "/publication-add-data-processing",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationAddDataProcessing",
            "loginRequire"
        ],
        "description" => "Функция которая обрабатывает данные с формы публикации"
    ],
    [
        "method" => 'GET',
        "path" => "/publication-add-answer",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationAddAnswer",
            "loginRequire"
        ],
        "description" => "Ответ после отправки формы публикации"
    ],
    [
        "method" => 'GET',
        "path" => "/publication/{id:\d+}",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "publicationDetail",
            "loginRequire"
        ],
        "description" => "Информация об отдельно взятой публикации"
    ],
    [
        "method" => 'GET',
        "path" => "/change-like/{publicationId:\d+}",
        "handler" => [
            "className" => "PublicationController",
            "methodName" => "changeLike",
            "loginRequire"
        ],
        "description" => "Меняет значение лайка на публикации на противоположный"
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
            "methodName" => "categoriesForPublicationAdd",
            "loginRequire"
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
    ],
    [
        "method" => "GET",
        "path" => "/register-answer",
        "handler" => [
            "className" => "UserController",
            "methodName" => "registerAnswer"
        ],
        "description" => "Ответ на регистрацию"
    ],
    [
        "method" => "GET",
        "path" => "/login",
        "handler" => [
            "className" => "UserController",
            "methodName" => "loginForm"
        ],
        "description" => "Форма авторизации"
    ],
    [
        "method" => "GET",
        "path" => "/check-login",
        "handler" => [
            "className" => "UserController",
            "methodName" => "checkLogin"
        ],
        "description" => "Асинхронная проверка данный при авторизации"
    ],
    [
        "method" => "POST",
        "path" => "/login-data-processing",
        "handler" => [
            "className" => "UserController",
            "methodName" => "loginDataProcessing"
        ],
        "description" => "Функция которая вызывается когда пользователь удачно зашел на аккаунт"
    ],
    [
        "method" => "GET",
        "path" => "/header-user-information",
        "handler" => [
            "className" => "UserController",
            "methodName" => "headerUserInformation"
        ],
        "description" => "Данные об авторизации для хэдера"
    ],
    [
        "method" => "GET",
        "path" => "/logout",
        "handler" => [
            "className" => "UserController",
            "methodName" => "logout",
            "loginRequire"

        ],
        "description" => "Разлогиниться"
    ],
    [
        "method" => "GET",
        "path" => "/user/{id:\d+}",
        "handler" => [
            "className" => "UserController",
            "methodName" => "userDetail",
            "loginRequire"

        ],
        "description" => "Стриница пользователя"
    ],


];

return $routes;