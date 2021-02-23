<title>Публикация</title>
<div id="pub-detail">
    <div class="pub-detail__container">
        <div class="pub-detail__body">
            <div class="pub-detail__row">
                <div class="pub-detail__first-column">
                    <div class="pub-detail__user-inf">
                        <div class="pub-detail__user-photo">
                            <img src="../static/img/user-photo.png" alt="">
                        </div>
                        <a :href="'/user/'+publication.userid" class="pub-detail__user-nickname">
                            {{ publication.nickname }}
                        </a>
                    </div>
                    <div class="pub-detail__other-categories">
                        <div class="other-categories">
                            <a href="/categories" class="other-categories__title">
                                Категории
                            </a>
                            <div class="other-categories__body">
                                <a v-for="category in categoryList" :href="'/publications/category='+category.id"
                                   class="other-categories__item">
                                    {{ category.categoryname }} <span
                                            v-if="category.id === publication.categoryid">✔</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pub-detail__second-column">
                    <div class="pub-detail__publication">
                        <div class="publication">
                            <div class="publication__body">
                                <div class="publication__modal" :class="{ active : activeModal }">
                                    <div id="modal">
                                        <div class="modal__body">
                                            <div class="modal__row">
                                                <div class="modal__img">
                                                    <img :src="'../media'+publication.photo" alt="">
                                                </div>
                                                <div class="modal__cross" @click="deactivateModal()">
                                                    ×
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="publication__img">
                                    <img :src="'../media'+publication.photo" alt="" class="publication__image">
                                    <div class="publication__fullscreen" @click="activateModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                                        </svg>
                                    </div>
                                </div>

                                <div v-if="publication.description" class="publication__data-item">
                                    <div class="subtitle">Описание:</div>
                                    {{ publication.description }}
                                </div>
                                <div  class="publication__data-item">
                                    <div class="subtitle">Просмотры:</div>
                                    {{ publication.views }} просмотров
                                </div>
                                <div  class="publication__data-item">
                                    <div class="subtitle">Дата создания публикации:</div>
                                    {{ publication.created }}
                                </div>
                                <div  class="publication__data-item">
                                    <div class="subtitle">Категория:</div>
                                    {{ publication.categoryname }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let a = new Vue({
        el: "#pub-detail",
        data: {
            publication: DATA.publication,
            categoryList: [],
            activeModal: false
        },
        mounted: function () {
            fetch("/get-category-list").then(response => response.json())
                .then(data => {
                    this.categoryList = data;
                });
        },
        methods: {
            deactivateModal() {
                this.activeModal = false;
            },
            activateModal(){
                this.activeModal = true;
            }
        }

    });
</script>