<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

<div id="headerimg">
    <div id="headerimg__body">
        <div class="headerimg__text">
            Добро пожаловать в Чернигов!
        </div>
    </div>
    <img id="headerimg__img" src="<?= STATIC_IMG ?>/headers-che.jpg" alt="">
</div>
<div id="navbar">
    <div class="container">
        <div class="navbar__row">
            <div class="navbar__logo">
                <a href="/">
                    <img src="<?= STATIC_IMG ?>/pushka-white.png" alt="">
                </a>
            </div>

            <div class="navbar__body">
                <div class="navbar__links">
                    <div class="navbar__link" @click="dropDown">
                        Публикации
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                        <div class="dropdown" :class="{ active:dropActive }">
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

                </div>
                <template v-if="data.isAuth">
                    <div class="navbar__user-links">
                        <div class="user-links">
                            <a :href="'/user/'+data.userdata.id" class="user-links__user">
                                {{ data.userdata.nickname }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="navbar__auth-links">
                        <div class="auth-links">
                            <a href="/register" class="auth-links__link">
                                Регстрация
                            </a>
                            <a href="/login" class="auth-links__link">
                                Вход
                            </a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: "#navbar",
        data: {
            data: [],
            dropActive: false,
        },
        mounted: function () {
            let url = "/header-user-information";
            fetch(url).then(response => response.json())
                .then(data => {
                    this.data = data;
                });
        },
        methods: {
            dropDown: function () {
                this.dropActive = !this.dropActive;
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

    window.onload = function () {
        document.getElementById("headerimg__img").style.filter = "blur(2px)";
        document.getElementById("headerimg__body").style.opacity = "1";
    }
</script>