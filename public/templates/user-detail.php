<div id="user">
    <title>Пользователь {{ userData.nickname }}</title>

    <div class="container">
        <div class="user__body">
            <div class="user__row">
                <div class="user__logo">
                    <img src="../static/img/user-photo.png" alt="">
                </div>
                <div class="user__nickname">
                    {{ userData.nickname }}
                </div>

                <div class="user__title">
                    Информация о пользователе
                </div>
                <div class="user__about-me">
                    <div class="user__subtitle">О пользователе:</div>
                    {{ userData.aboutme }}
                </div>
                <div class="user__created">
                    <div class="user__subtitle">Дата регистрации:</div>
                    {{ userData.created }}
                </div>
                <div class="user__pub-count">
                    <div class="user__subtitle">Количество публикаций:</div>
                    <div style="margin-bottom: 15px">{{ userData.pubCount }}</div>
                    <a :href="'/publications?userid='+userData.id" class="pub-count__button">
                        Посмотреть публикации пользователя
                    </a>
                </div>
                <a href="/logout" class="user__logout" v-if="userData.itsMe">
                    <div>Выйти</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                         class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd"
                              d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: "#user",
        data: {
            userData: DATA.userData
        }
    });
</script>

