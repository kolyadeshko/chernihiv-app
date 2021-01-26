<h1>Ответ</h1>


<?php if ($answerData["isValid"]): ?>
    <h2>Успех!</h2>
    Ваша публикация отпавлена!
    <img src="<?= STATIC_IMG . "/success.png"; ?>" height="200px" alt="">
    <?php var_dump($answerData); ?>
<?php elseif (!$answerData["isValid"]): ?>
    <h2>Не успех</h2>
    Публикация не была отправлена
    <img src="<?= STATIC_IMG . "/unsuccess.png"; ?>" height="200px" alt="">
    Ошибки:
<ul>
    <?php foreach ($answerData["answerData"] as $key=>$value):?>
    <li><?= $value; ?></li>
    <?php  endforeach; ?>
</ul>
<?php endif; ?>


<div style="text-align: center"><a href="/"><<<\На главную</a> <a href="/publication-add">К заполнению формы>>></a></div>
