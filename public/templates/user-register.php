<div class="auth">
    <div class="auth__container">
        <div class="auth__row">
            <div class="auth__title">
                Регистрация
            </div>
            <div class="auth__body">

                <form id="register__form" action="/register-data-processing" method="post" @submit="checkForm"
                      novalidate>
                    <template v-if="serverErrors">
                        <div class="form__server-errors">
                            <div class="form__errors">
                                <ul class="errors__list">

                                        <li class="errors_item" v-for="error in serverErrors">
                                            {{ error }}
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </template>
                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__nickname">Ваш ник: </label>
                        </div>
                        <div
                                class="form__input"
                                :class="{
                                    'valid' : nicknameData.valid,
                                    'invalid':nicknameData.valid===false
                                }">
                            <input
                                    type="text"
                                    v-model="nickname"
                                    name="nickname"
                                    id="form__nickname"
                            >
                        </div>
                        <div class="form__errors" v-if="nicknameData.errors.length">
                            <ul class="errors__list">
                                <li class="errors_item" v-for="error in nicknameData.errors">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__email">Ваш email:</label>
                        </div>
                        <div
                                class="form__input"
                                :class="{
                                    'valid' : emailData.valid === true,
                                    'invalid':emailData.valid === false
                                }">
                            <input
                                    type="text"
                                    v-model="email"
                                    name="email"
                                    id="form__email"
                            >
                        </div>
                        <div class="form__errors" v-if="emailData.errors.length">
                            <ul class="errors__list">
                                <li class="errors_item" v-for="error in emailData.errors">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__password">Введите пароль:</label>
                        </div>
                        <div
                                class="form__input"
                                :class="{
                                    'valid' : passwordData.valid,
                                    'invalid':passwordData.valid===false
                                }">
                            <input
                                    :type="passwordType"
                                    v-model="password"
                                    name="password"
                                    id="form__password"

                            >
                            <div id="password__reliability"
                                 v-if="passwordReliability.reliability && passwordData.valid">
                                Надежность:
                                <div id="password__reliability-text" :class="passwordReliability.relClass">
                                    {{ passwordReliability.reliability }}
                                </div>
                            </div>
                            <div id="password__show">Показать пароль: <input v-model="passwordData.showPassword"
                                                                             type="checkbox"></div>
                            <div class="form__errors" v-if="passwordData.errors.length">
                                <ul class="errors__list">
                                    <li class="errors_item" v-for="error in passwordData.errors">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form__item">
                        <div class="form__subtitle">
                            <label for="form__description">Немного о Вас(необязательно):</label>
                        </div>
                        <div class="form__input">
                                <textarea
                                        name="aboutme"
                                        v-model="description"
                                        id="form__description"
                                >
                                </textarea>
                        </div>

                    </div>
                    <div class="form__button">
                        <input type="submit" v-bind:disabled="!validForm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../static/js/register-form.js"></script>
