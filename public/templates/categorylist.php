<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/styles.css">
    <title>Категории</title>
</head>
<body>
<?php  include "includes/header.php"?>

<div id="main-section">
    <div class="main-section__body">
        <a href="/publications" class="item" style="flex:0 0 60%;">
            <div class="item__body">
                <div class="item__logo">
                    <img src="<?= MEDIA . "/category/vse.jpg"; ?>" alt="">
                </div>
                <div class="item__title">Все публикации</div>
            </div>
        </a>
        <div id="category-info">
            <div class="category-info__body">
                <div class="category-info__title">
                    Категории публикаций
                </div>
                <div class="category-info__text">
                    fdlafaflas;fl;kas;lkf;lkas;lkf;lsak;lf
                    sald;lksa;ld;saklkf
                    ldksjvlksfjlsdlfjsdfds
                    ljdslkfsdljflsd
                </div>
            </div>
        </div>
    </div>
</div>
<div class="categorylist">
    <div class="categorylist__row">
        <?php foreach ($categories as $i): ?>
            <a href="/publications/category=<?= $i->id; ?>" class="item">
                <div class="item__body">
                    <div class="item__logo">
                        <img src="<?= MEDIA . $i->photo; ?>" alt="">
                    </div>
                    <div class="item__title"><?= $i->categoryname; ?></div>
                    <div class="item__count">
                        (<?= $i->pub_count; ?>)
                        <div class="item__count-prom">
                            Кол-во записей по данной категории
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<script src="../static/js/scripts.js"></script>
</body>
</html>
