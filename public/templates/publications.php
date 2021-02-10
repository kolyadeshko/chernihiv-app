
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/styles.css">
    <title>Публикации</title>
</head>
<body>
<?php  include "includes/header.php"?>
<div class="publications">
    <div class="publications__body">
        <div class="publications__row">
            <?php foreach ($publications as $k => $v): ?>
                <?php if ($v->publicated): ?>
                    <div class="publications__p-item">
                        <div class="p-item__logo">
                            <img src="<?= MEDIA . $v->photo ?>" alt="" width="300px">
                        </div>
                        <div class="p-item__body">
                            <div class="p-item__created">
                                <div class="p-item__title">Дата публикации:</div>
                                <?php echo date("d.m.Y H:m", strtotime($v->created)); ?>
                            </div>

                            <a href="/user/<?= $v->userid; ?>" class="p-item__user">
                                <div class="p-item__title">Автор:</div>
                                <?php echo $v->nickname; ?>
                            </a>
                            <a href="/publication/<?= $v->id; ?>" class="p-item__button">Ближе</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="../static/js/scripts.js"></script>
</body>
</html>
