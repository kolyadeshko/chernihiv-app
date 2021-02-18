<div id="publications">
    <div class="publications__body">
        <div class="publications__row">
            <div class="publications__p-item" v-for="publication in publications">
                <div class="p-item__logo">
                    <img :src="'../media'+publication.photo" alt="">
                </div>
                <div class="p-item__body">
                    <div class="p-item__created">
                        <div class="p-item__title">Дата публикации:</div>
                        {{ publication.created }}
                    </div>

                    <a :href="'/user/'+publication.userid" class="p-item__user">
                        <div class="p-item__title">Автор:</div>
                        {{ publication.nickname }}
                    </a>
                    <a :href="'/publication/'+ publication.id" class="p-item__button">Ближе</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const a = new Vue({
        el: "#publications",
        data: {
            publications: DATA.publications
        }
    })
</script>
