<div class="auth">
    <div class="auth__container">
        <div class="auth__row">
            <div class="auth__title">
                Авторизация
            </div>
            <div class="auth__body">
                <form action="/login-data-processing" id="login__form" :class="{ curtain:curtain }"
                      @submit.prevent="checkLogin" method="post">
                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__nickname">Ваш ник:</label>
                        </div>
                        <div class="form__input">
                            <input
                                    type="text"
                                    v-model="nickname"
                                    name="nickname"
                                    id="form__nickname"
                            >
                        </div>

                    </div>
                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__password">Введите пароль:</label>
                        </div>
                        <div class="form__input">
                            <input type="password" v-model="password" id="form__password">
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__input">
                            <div class="remember-me">
                                <div class="remember-me__body">
                                    <div class="remember-me__text">Запомнить меня:</div>
                                    <input type="checkbox" name="remember-me" class="remember-me__input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form__errors" v-if="errors.length">
                        <ul class="errors__list">
                            <li class="errors_item">{{ errors }}</li>
                        </ul>
                    </div>
                    <div class="form__button">
                        <input type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../static/js/login.js"></script>
