<title>Главная страница</title>
<link rel="stylesheet" href="../static/css/mainpage.css">
<div id="mainpage">
    <div class="mainpage__body">
        <div class="mainpage__row">
            <div class="mainpage__get-started">
                <div class="get-started">
                    <div class="get-started__body">
                        <img src="../static/img/mainpage-img.jpg" alt="">
                        <div class="get-started__content">
                            <div class="get-started__title">
                                Нравится делать красивые фотографии?
                                Любишь свой родной город?
                                Тогда тебе к нам!
                            </div>
                            <div class="get-started__text">
                                На нашем сайте вы можете зазместить свои лучший фотографии связанные с нашим городом.
                            </div>
                            <a href="/publication-add" class="get-started__start p-item__button">
                                Опубликовать свою работу
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mainpage__pub-slider">
                <div class="pub-slider">
                    <div class="pub-slider__body">
                        <div class="pub-slider__slider">
                            <div class="pub-slider__slide" v-for="publication,index in popularPublic"
                                 :class="[ (index + 1) === currentSlide ? 'active' : '' ]">
                                <div class="pub-slider__number"> {{ index + 1 }}/ 4</div>
                                <a title="Перейти к публикации" class="pub-slider__link" :href="'publication/'+publication.id">
                                    🔗
                                </a>
                                <div class="pub-slider__views">
                                    👁
                                    {{ publication.views }}
                                </div>
                                <img :src="'../media' + publication.photo">
                            </div>
                            <a class="pub-slider__prev" @click="changeSlide(-1)">&#10094;</a>
                            <a class="pub-slider__next" @click="changeSlide(1)">&#10095;</a>
                        </div>
                    </div>
                    <div class="pub-slider__row">
                        <div class="pub-slider__column" v-for="publication,index in popularPublic"
                             @click="getSlide(index+1)" :class="[ (index + 1) === currentSlide ? 'active' : '' ]">
                            <img :src="'../media' + publication.photo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../static/js/mainpage.js"></script>
