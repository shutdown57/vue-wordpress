<template>
    <div>
        <h1>{{ msg }}</h1>
        <div class="row">
            <div class="col-xs-12 col-md-6" v-for="article in articleList">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media" dir="rtl">
                            <div class="media-right">
                                <router-link :to="{name: 'blogSingle', params:{pid: article.id}}">
                                    <image-loader width="150" height="170" center-type="cover" :blur-preview="true" :src="article.img_info[0].img_url" class="media-object img-responsive img-rounded"></image-loader>
                                </router-link>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading text-info">{{ article.title.rendered }}</h2>
                                <p v-html="article.content.rendered"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div>
</template>

<script>
/**
*   @component: BlogAll
*/
import {mapState, mapActions} from 'vuex';
import VueImageLoader from 'vue-img-loader';

export default {
    name: 'blogAll',

    components: {
        'image-loader': VueImageLoader
    },

    data() {
        return {
            msg: 'اخبار ایرانیان مگنت'
        };
    },

    computed: {
        ...mapState({
            articleList: ({articleList}) => articleList.items
        })
    },

    created() {
        window.document.title = "اخبار";
        if (this.articleList.length < 1) {
        this.getPostsBlog();
        }
    },

    methods: {
        ...mapActions([
        'getPostsBlog'
        ])
    }
}
</script>

<style scoped>
.direction-rtl{
    direction: rtl;
}

/* img {
    width: 128px;
    height: 128px;
} */
</style>
