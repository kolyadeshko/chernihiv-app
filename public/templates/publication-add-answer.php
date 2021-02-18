<title>Ответ</title>
<div id="answer">
    <div class="container">
        <template v-if="answerData.isValid">
            <div class="answer__row">
                <div class="answer__logo">
                    <img src="<?= STATIC_IMG . "/success.png"; ?>" alt="">
                </div>
                <div class="answer__body">
                    <div class="answer__title">Ураа!Публикация отправлена!
                    </div>
                    <div class="answer__text">
                        Ваша публикация уже находится в базе данных. Администраторы проверят Вашу публикацию на
                        корректность
                        и
                        отсутствие рекламы. После этого Ваша публикация будут опубликована и все посетители нашего сайта
                        смогут увидеть Вашу работу!
                    </div>
                </div>
            </div>
            <div class="answer__content">
                <div class="answer__publication">
                    <div class="answer__photo">
                        <img :src="'../media' + answerData.answerData.photo" alt="">
                    </div>
                </div>
                <div class="answer__a-links">
                    <div class="a-links__body">
                        <a class="a-links__link" href="/">На главную</a>
                        <a class="a-links__link" href="/publications">К публикациям</a>
                        <a class="a-links__link" href="/publication-add">К заполнению формы</a>
                    </div>
                </div>
            </div>
        </template>

        <template v-else-if="!answerData.isValid">
            <div class="answer__row">
                <div class="answer__logo">
                    <img src="<?= STATIC_IMG . "/unsuccess.png"; ?>" alt="">
                </div>
                <div class="answer__body">
                    <div class="answer__title">К сожалению, публикация не была отправлена!
                    </div>
                    <div class="answer__text">
                        <ul>
                            <li v-for="error in answerData.answerData">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="answer__content">
                <div class="answer__a-links">
                    <div class="a-links__body">
                        <a class="a-links__link" href="/">На главную</a>
                        <a class="a-links__link" href="/publications">К публикациям</a>
                        <a class="a-links__link" href="/publication-add">К заполнению формы</a>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
<script>
    new Vue({
        el: "#answer",
        data: {
            answerData: DATA.answerData
        }
    });
</script>
