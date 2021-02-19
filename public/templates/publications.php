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
            paginationInfo: DATA.paginationInfo
        },
        methods: {
            getCurrentUrl: function () {
                return window.location.href;
            },

            getPage: function (pageNum) {
                let currentUrl = this.getCurrentUrl();
                if ((/\?page=\d+/).test(currentUrl)) {
                    currentUrl = currentUrl.replace(/\?page=\d+/, "?page=" + pageNum);
                } else {
                    currentUrl += "?page=" + pageNum
                }
                return currentUrl;
            },
            checkActive: function (page) {
                let currentUrl = this.getCurrentUrl();
                if (page === 1 && !(/\?page=\d+/).test(currentUrl)){
                    return true
                }
                return this.getPage(page) === currentUrl;
            }
        },


    });

</script>
