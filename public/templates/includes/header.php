<div id="navbar">
    <div class="container">
        <div class="navbar__row">
            <div class="navbar__logo">
                <a href="/">
                    <img src="<?= STATIC_IMG ?>/pushka-white.png" alt="">
                </a>
            </div>

            <div class="navbar__body" :class="{ active : navActive }">
                <div class="navbar__links">
                    <div class="navbar__link">
                        Публикации
                        <div class="dropdown">
                            <a href="/publications">
                                Все публикации
                            </a>
                            <a href="/categories">
                                Категории
                            </a>
                            <a href="/publication-add">
                                Добавить публикацию
                            </a>
                        </div>
                    </div>
                    <div class="navbar__link" v-if="!data.isAuth">
                        Авторизация
                        <div class="dropdown">
                            <a href="/register">
                                Регистрация
                            </a>
                            <a href="/login">
                                Войти
                            </a>
                        </div>
                    </div>
                    <div class="navbar__link" v-else-if="data.isAuth">
                        {{ data.userdata.nickname }}
                        <div class="dropdown">
                            <a :href="'/user/'+data.userdata.id">
                                Мой аккаунт
                            </a>
                            <a href="/logout">
                                Выйти
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar__burger" @click="activateNav">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" color="white" fill="currentColor"
                     class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: "#navbar",
        data: {
            data: [],
            navActive : false
        },
        mounted: function () {
            let url = "/header-user-information";
            fetch(url).then(response => response.json())
                .then(data => {
                    this.data = data;
                });
        },
        methods: {
            activateNav(){
                this.navActive = !this.navActive;
            }
        },
    });
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-100%";
        }
        prevScrollpos = currentScrollPos;
    }

</script>