<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/styles.css">
    <title>Регистрация пользователя</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <meta http-equiv="Cache-Control" content="no-cache">

</head>
<body>
<?php include "includes/header.php" ?>
<div class="register">
    <div class="register__container">
        <div class="register__row">
            <div class="register__title">
                Регистрация
            </div>
            <div class="register__body">

                <form id="register__form" action="/register-data-processing" method="post" @submit="checkForm"
                      novalidate>
                    <?php if ($serverErrors): ?>
                        <?php foreach ($serverErrors as $key => $value) : ?>
                            <div class="form__server-errors">
                                <div class="form__errors">
                                    <ul class="errors__list">
                                        <li class="errors_item">
                                            <?= $value; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                    <div class="form__button">
                        <input type="submit" v-bind:disabled="!validForm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../static/js/scripts.js"></script>
<script src="../static/js/register-form.js"></script>
</body>
</html>