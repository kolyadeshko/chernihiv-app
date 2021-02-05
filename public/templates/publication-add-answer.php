
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
<?php  include "includes/header.php"?>

<div id="answer">
    <div class="container">
        <?php if ($answerData["isValid"]): ?>
            <div class="answer__row">
                <div class="answer__logo">
                    <img src="<?= STATIC_IMG . "/success.png"; ?>" alt="">
                </div>
                <div class="answer__body">
                    <div class="answer__title">Ураа!Публикация отправлена!
                    </div>
                    <div class="answer__text">
                        Ваша публикация уже находится в базе данных. Администраторы проверят Вашу публикацию на
                        корректность
                        и
                        отсутствие рекламы. После этого Ваша публикация будут опубликована и все посетители нашего сайта
                        смогут увидеть Вашу работу!
                    </div>
                </div>
            </div>
            <div class="answer__content">
                <div class="answer__publication">
                    <div class="answer__photo">
                        <img src="<?= MEDIA . $answerData['answerData']['photo'] ?>" alt="">
                    </div>
                </div>
                <div class="answer__a-links">
                    <div class="a-links__body">
                        <a class="a-links__link" href="/">На главную</a>
                        <a class="a-links__link" href="/publications">К публикациям</a>
                        <a class="a-links__link" href="/publication-add">К заполнению формы</a>
                    </div>
                </div>
            </div>
        <?php elseif (!$answerData["isValid"]): ?>
            <div class="answer__row">
                <div class="answer__logo">
                    <img src="<?= STATIC_IMG . "/unsuccess.png"; ?>" alt="">
                </div>
                <div class="answer__body">
                    <div class="answer__title">К сожалению, публикация не была отправлена!
                    </div>
                    <div class="answer__text">
                        <ul>
                            <?php foreach ($answerData["answerData"] as $k=>$v): ?>
                                <li><?= $v ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="answer__content">
                <div class="answer__a-links">
                    <div class="a-links__body">
                        <a class="a-links__link" href="/">На главную</a>
                        <a class="a-links__link" href="/publications">К публикациям</a>
                        <a class="a-links__link" href="/publication-add">К заполнению формы</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="../static/js/scripts.js"></script>
</body>
</html>