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
        <div id="ordering">
            <div class="ordering__row">
                <div class="ordering__title">
                    Сортировка
                </div>
                <div class="ordering__body">
                    <div class="ordering__subtitle">
                        Сортировать по:
                    </div>
                    <div class="ordering__orderby">
                        <div class="ordering__item">
                            <input type="radio" name="orderby">Просмотрам
                        </div>
                        <div class="ordering__item">
                            <input type="radio" name="orderby">Дате публикации
                        </div>
                        <div class="ordering__item">
                            <input type="radio" name="orderby">Публикации
                        </div>
                    </div>
                    <hr>
                    <div class="ordering__ordering">
                        <div class="ordering__item">
                            <input type="radio" name="ordering">По убыванию
                        </div>
                        <div class="ordering__item">
                            <input type="radio" name="ordering">По возрастанию
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="publications-pagination">
            <div class="pagination">
                <div class="pagination__body">
                    <div class="pagination__row">
                        <a :href="getPage(page)" class="pagination__item" :class="{ active : checkActive(page) }"
                           v-for="page in paginationInfo.pageCount">
                            {{ page }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: "#publications",
        data: {
            publications: DATA.publications,
            paginationInfo: DATA.paginationInfo,
        },
        methods: {
            getPage: function (pageNum) {
                let url = new URL(window.location.href);
                url.searchParams.set('page',pageNum)
                return url.href;
            },
            checkActive: function (page) {
                let url = new URL(window.location.href);
                let currentPage = url.searchParams.get('page');
                if (!url.searchParams.has('page') && page === 1){
                    return true;
                } else if (currentPage === String(page)){
                    return true;
                }
                return false
            }
        },


    });

</script>
