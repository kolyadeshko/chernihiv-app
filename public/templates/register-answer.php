<title>Ответ</title>
<div id="answer">
    <div class="container">
        <div class="answer__row">
            <div class="answer__logo">
                <img src="<?= STATIC_IMG . "/success.png"; ?>" alt="">
            </div>
            <div class="answer__body">
                <div class="answer__title">Поздравляем!
                </div>
                <div class="answer__text">
                    Пользователь с именем
                    <span class="answer__bold">
                    {{ answer.nickname }}
                    </span> и <span class="answer__bold"> {{ answer.email }}</span>
                    успешно зарегестрирован! Теперь вы можете <a href="/login" class="answer__bold">авторизоваться</a>
                    и получить к многим функциям, например - добавление записи.
                </div>
            </div>
        </div>
        <div class="answer__content">
            <div class="answer__a-links">
                <div class="a-links__body">
                    <a class="a-links__link" href="/">На главную</a>
                    <a class="a-links__link" href="/publications">К публикациям</a>
                    <a class="a-links__link" href="/login">К авторизации</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el : "#answer",
        data : {
            answer : DATA.answer
        }
    })
</script>
