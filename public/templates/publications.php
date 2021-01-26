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
                                <?php echo $v->username; ?>
                            </a>
                            <a href="/publication/<?= $v->id; ?>" class="p-item__button">Ближе</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

