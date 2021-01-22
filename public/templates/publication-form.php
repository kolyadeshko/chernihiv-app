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
                    <textarea name="description" id="formDescription" cols="30" rows="10" placeholder="Необязательно..."></textarea>
                </div>
                <div class="form__item">
                    <div class="form__title">Прикрепить фотографию</div>
                    <div class="file">
                        <div class="file__item">
                            <input accept=".jpg, .png, .gif, .jpeg" type="file" name="image" id="formImage" class="file__input" required>
                        </div>
                        <div class="file__preview" id="formPreview"></div>
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
    document.addEventListener("DOMContentLoaded",function (){

        const formImage = document.getElementById("formImage");
        const formPreview = document.getElementById("formPreview");

        formImage.addEventListener("change",() => {
            uploadFile(formImage.files[0]);
        });

        function uploadFile(file){
            if (!['image/jpeg','image/jpg','image/png','image/gif'].includes(file.type)){
                alert("Разрешены только изображения");
                formImage.value = '';
                return;
            }
            if(file.size > 5 * 1024 * 1024){
                alert("Файл должен быть менее 2 МБ");
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result);
                formPreview.innerHTML = `<img src="${e.target.result}" alt="Фото">`
            };
            reader.onerror = function (e) {
                alert("Ошибка")
            };
            reader.readAsDataURL(file);
        }
    });
</script>