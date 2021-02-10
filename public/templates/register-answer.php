<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/styles.css">
    <title>Ответ</title>
</head>
<body>
<?php include "includes/header.php" ?>

<div id="answer">
    <div class="container">
        <div class="answer__row">
            <div class="answer__logo">
                <img src="<?= STATIC_IMG . "/success.png"; ?>" alt="">
            </div>
            <div class="answer__body">
                <div class="answer__title">Поздравляем!
                </div>
                <div class="answer__text">
                    Пользователь с именем
                    <span class="answer__bold">
                        <?= $answer['nickname'] ?>
                    </span> и <span class="answer__bold"> <?= $answer['email'] ?></span>
                    успешно зарегестрирован! Теперь вы можете <a href="/login" class="answer__bold">авторизоваться</a>
                    и получить к многим функциям, например - добавление записи.
                </div>
            </div>
        </div>
        <div class="answer__content">
            <div class="answer__a-links">
                <div class="a-links__body">
                    <a class="a-links__link" href="/">На главную</a>
                    <a class="a-links__link" href="/publications">К публикациям</a>
                    <a class="a-links__link" href="/login">К авторизации</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../static/js/scripts.js"></script>
</body>
</html>
