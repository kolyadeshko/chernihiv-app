<title>Добавить публикацию</title>
<div class="publication-add">
    <div class="publication-add__container">
        <div class="publication-add__row">
            <div class="publication-add__title">
                Добавление публикации
            </div>
            <div class="publication-add__body">
                <form method="post" id="publication-add__form" enctype="multipart/form-data"
                      action="/publication-add-data-processing">
                    <div class="form__item">
                        <div class="form__subtitle">
                            Категория:
                        </div>
                        <div class="form__input">
                            <div class="form__options">
                                <div class="form__option">
                                    <input v-model="categoryValue" id="forLabelWithout" type="radio" name="categoryid"
                                           value="" class="option__input" checked>
                                    <label for="forLabelWithout">Без категории</label>
                                </div>
                                <div class="form__option" v-for="category in categoryList">
                                    <input v-model="categoryValue" :id="'forLabel'+category.id" type="radio"
                                           name="categoryid" :value="category.id" class="option__input">
                                    <label :for="'forLabel'+category.id">{{ category.categoryname }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__description">Описание:</label>
                        </div>
                        <div class="form__input">
                                <textarea
                                        name="description"
                                        v-model="description"
                                        id="form__description"
                                >
                                </textarea>
                        </div>

                    </div>
                    <div class="form__item">
                        <div class="form__subtitle">
                            Фотография
                        </div>
                        <div class="file">
                            <div class="file__container">
                                <input
                                        accept=".jpg, .png, .gif, .jpeg"
                                        type="file"
                                        name="image"
                                        id="file__input"
                                        @change="uploadImage"
                                        ref="image"
                                        required
                                >
                                <div class="file__button">
                                    <img src="../static/img/clip.ico" alt="">
                                </div>
                            </div>
                            <div class="file__data" v-if="previewImage">
                                <div class="data">
                                    <div class="data__body">
                                        <div class="data__item">
                                            Название: {{ imageData.name }}
                                        </div>
                                        <div class="data__item">
                                            Размер:{{ imageData.size }}
                                        </div>
                                        <div class="data__item">
                                            Тип:{{ imageData.type }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="file__preview" v-if="previewImage">
                                <div class="preview">
                                    <div class="preview__body">
                                        <img :src="previewImage" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form__errors" v-if="fileData.errors.length">
                            <ul class="errors__list">
                                <li class="errors_item" v-for="error in fileData.errors">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form__button">
                        <input type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../static/js/publication-add.js"></script>
