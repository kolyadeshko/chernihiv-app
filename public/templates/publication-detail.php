<title>Публикация</title>
<div id="pub-detail">
    <div class="pub-detail__container">
        <div class="pub-detail__body">
            <div v-if="publication" class="pub-detail__row">
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
                                <div class="publication__down">
                                    <div class="publication__data">
                                        <div v-if="publication.description" class="publication__data-item">
                                            <div class="subtitle">Описание:</div>
                                            {{ publication.description }}
                                        </div>
                                        <div class="publication__data-item">
                                            <div class="subtitle">Просмотры:</div>
                                            {{ publication.views }} просмотров
                                        </div>
                                        <div class="publication__data-item">
                                            <div class="subtitle">Дата создания публикации:</div>
                                            {{ publication.created }}
                                        </div>
                                        <div class="publication__data-item">
                                            <div class="subtitle">Категория:</div>
                                            {{ publication.categoryname }}
                                        </div>
                                    </div>
                                    <div class="publication__like">
                                        <div class="like">
                                            <div class="like__body">
                                                <div class="like__heart">
                                                    <svg v-if="liked" @click="changeLike()"
                                                         style="color: #ff4747;height: 60px;width: 60px;"
                                                         xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-heart-fill"
                                                         viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                    </svg>
                                                    <svg v-else @click="changeLike()"
                                                         style="color:red;height: 60px;width: 60px"
                                                         xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-suit-heart"
                                                         viewBox="0 0 16 16">
                                                        <path d="M8 6.236l-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                                    </svg>

                                                </div>
                                                <div class="like__count">
                                                    {{ publication.likes }}
                                                </div>
                                                <div :class="{ active : liked }" class="like__text">
                                                    Вам понравилось
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="no-publication">
                <div class="no-publication__message">
                    <div class="no-publication__body">
                        <div class="no-publication__img">
                            <img src="../static/img/sad((.jpg" alt="">
                        </div>
                        <div class="no-publication__text">
                            К сожалению данной публикации не существует.
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
            activeModal: false,
            liked: DATA.publication.liked
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
            activateModal() {
                this.activeModal = true;
            },
            changeLike: function () {
                let likes = parseInt(this.publication.likes);
                this.liked ? likes -= 1 : likes += 1
                this.publication.likes = likes;
                this.liked = !this.liked;
                fetch(`/change-like/${this.publication.id}`).then(response => {
                });
            },
        }

    });
</script>`