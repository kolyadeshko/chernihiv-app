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
<div class="auth">
    <div class="auth__container">
        <div class="auth__row">
            <div class="auth__title">
                Авторизация
            </div>
            <div class="auth__body">
                <form action="/login-data-processing" id="login__form" :class="{ curtain:curtain }" @submit.prevent="checkLogin" method="post">
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
                    <div class="form__errors" v-if="errors.length">
                        <ul class="errors__list">
                            <li class="errors_item">{{ errors[0] }}</li>
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
<script src="../static/js/scripts.js"></script>
<script src="../static/js/login.js"></script>
</body>
</html>