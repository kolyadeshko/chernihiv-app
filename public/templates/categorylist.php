<div id="main-section">
    <div class="main-section__body">
        <a href="/publications" class="item" style="flex:0 0 60%;">
            <div class="item__body">
                <div class="item__logo">
                    <img src="<?= MEDIA . "/category/vse.jpg"; ?>" alt="">
                </div>
                <div class="item__title">Все публикации</div>
            </div>
        </a>
        <div id="category-info">
            <div class="category-info__body">
                <div class="category-info__title">
                    Категории публикаций
                </div>
                <div class="category-info__text">
                    fdlafaflas;fl;kas;lkf;lkas;lkf;lsak;lf
                    sald;lksa;ld;saklkf
                    ldksjvlksfjlsdlfjsdfds
                    ljdslkfsdljflsd
                </div>
            </div>
        </div>
    </div>
</div>
<div id="categorylist">
    <div class="categorylist__row">
        <template v-for="category in categories">
            <a :href="'/publications/category='+category.id" class="item">
                <div class="item__body">
                    <div class="item__logo">
                        <img :src="'../media' + category.photo" alt="">
                    </div>
                    <div class="item__title">{{ category.categoryname }}</div>
                    <div class="item__count">
                        ({{ category.pub_count }})
                        <div class="item__count-prom">
                            Кол-во записей по данной категории
                        </div>
                    </div>
                </div>
            </a>
        </template>
    </div>
</div>
<script>
    const a = new Vue({
        el : "#categorylist",
        data : {
            categories : DATA.categories
        }
    });
</script>
