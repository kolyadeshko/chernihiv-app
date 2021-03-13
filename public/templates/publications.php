<title>Публикации</title>
<div id="publications">
    <div class="publications__body">
        <div id="ordering">
            <div class="ordering__row">
                <div class="ordering__title">
                    <div class="ordering__title-text">
                        Сортировка
                    </div>
                    <div class="ordering__drop-btn" @click="changeSortActive()" :class="{ active : activeSort }">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                        </svg>
                    </div>
                </div>
                <div class="ordering__body" :class="{ active : activeSort }">
                    <div class="ordering__subtitle">
                        Сортировать по:
                    </div>
                    <div class="ordering__orderby">
                        <div class="ordering__item">
                            <input type="radio" v-model="orderby" value="views"  name="orderby" id="viewsSort"> <label for="viewsSort">Просмотрам</label>
                        </div>
                        <div class="ordering__item">
                            <input type="radio" v-model="orderby" value="created"  name="orderby" id="dateSort">
                            <label for="dateSort">Дате публикации</label>

                        </div>
                        <div class="ordering__item">
                            <input type="radio" v-model="orderby" value="likes"  name="orderby" id="likesSort"> <label for="likesSort">Лайкам</label>
                        </div>
                    </div>
                    <hr>
                    <div class="ordering__ordering">
                        <div class="ordering__item">
                            <input type="radio" v-model="ordering" value="desc" name="ordering" id="desc"><label for="desc">По убыванию</label>
                        </div>
                        <div class="ordering__item">
                            <input type="radio" v-model="ordering" value="asc" name="ordering" id="asc"> <label for="asc">По возрастанию</label>
                        </div>
                    </div>
                    <a :href="sortLink()" class="ordering__btn">Сортировать</a>
                </div>
            </div>
        </div>

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
                    <div class="p-item__likes-views">
                        ❤️ {{ publication.likes }}
                        👁 {{ publication.views }}
                    </div>
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
    let v = new Vue({
        el: "#publications",
        data: {
            publications: DATA.publications,
            paginationInfo: DATA.paginationInfo,
            activeSort : false,
            orderby : "",
            ordering : ""
        },
        methods: {
            getPage: function (pageNum) {
                let url = new URL(window.location.href);
                url.searchParams.set('page', pageNum)
                return url.href;
            },
            checkActive: function (page) {
                let url = new URL(window.location.href);
                let currentPage = url.searchParams.get('page');
                if (!url.searchParams.has('page') && page === 1) {
                    return true;
                } else if (currentPage === String(page)) {
                    return true;
                }
                return false
            },
            changeSortActive : function () {
                this.activeSort = !this.activeSort;
            },
            sortLink(){
                let url = new URL(window.location.href);
                url.searchParams.set('page','1');
                if (this.orderby){
                    url.searchParams.set('orderby',this.orderby);
                }
                if (this.ordering){
                    url.searchParams.set('ordering',this.ordering);
                }
                return url.href;
            },
            getChecked(key,value){
                let url = new URL(window.location.href);
                if (url.searchParams.has(key)){
                    if (url.searchParams.get(key) === value){
                        return true
                    }
                }
                return false;
            }
        },
    });


</script>
