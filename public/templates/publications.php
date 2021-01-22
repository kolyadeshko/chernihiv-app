<div class="publications">
    <div class="publications__body">
        <div class="publications__row">
            <?php foreach ($publications as $k => $v): ?>
                <div class="publications__p-item">
                    <div class="p-item__logo">
                        <img src="<?= MEDIA . $v->photo ?>" alt="" width="300px">
                    </div>
                    <div class="p-item__created">
                        <?php var_dump(date("M d h", strtotime($v->created))); ?>
                        <?php echo $v->username,$v->userid,$v->categoryname; ?>
                    </div>
                    <div class="p-item__user">

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

