<div id="publication-add">
    <div class="container">
        <div class="publication-add__form">
            <form action="#" id="form">
                <h1 class="form__title">Создание публикации</h1>
                <div class="form__item">
                    <div class="options">
                        <div class="options__item">
                            <input id="forLabelWithout"  type="radio" name="category" value="null" class="options__input" checked>
                            <label for="forLabelWithout">Без категории</label>
                        </div>
                        <?php foreach ($categories as $key=>$value): ?>
                        <div class="options__item">
                            <input id="forLabel<?= $value->id ?>"  type="radio" name="category" value="<?= $value->id ?>" class="options__input">
                            <label for="forLabel<?= $value->id ?>"><?= $value->categoryname; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form__item">
                    <label for="formDescription">Описание</label>
                    <textarea name="description" id="formDescription" cols="30" rows="10"></textarea>
                </div>
                <div class="form__item">
                    <div class="form__title">Прикрепить фотографию</div>
                    <div class="file">
                        <div class="file__item">
                            <input accept=".jpg, .png, .gif" type="file" name="image" class="file__input">
                            <button class="file__button">Выбрать</button>
                        </div>
                        <div class="file__preview"></div>
                    </div>
                </div>
                <button type="submit" class="form__button">Отправить</button>
            </form>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<script>
    "use strict"
    document.addEventListener("DOMContentLoader",function (){
        const form = document.getElementById("form");
    })
</script>