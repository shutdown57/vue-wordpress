<template>
    <div class="direction-rtl">
        <h1>{{ msg }}</h1>
        <router-view></router-view>
        <div class="row">
            <div class="col-xs-12" v-for="article in articleList">
                <div class="media">
                    <div class="media-right">
                        <img :src="article.img_url" :alt="article.img_title" class="media-object">
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">{{ article.title.rendered }}</h2>
                        <p v-html="article.content.rendered"></p>
                        <p>{{article.id}}</p>
                        <p>{{api}}</p>
                        <router-link :to="{name: 'blogSingle', params:{id: article.id}}" exact class="btn btn-success">ادامه مطلب</router-link>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" v-for="article in articleList">
                <h2>{{ article.title.rendered }}</h2>
                <img :src="article.img_url" :alt="article.img_title">
                <div v-html="article.content.rendered"></div>
                <div>
                    <h5>Categories:</h5>
                    <span v-for="cat in article.cats">
                        <a :href="cat.link"> {{cat.name}} </a>
                    </span>
                </div>
                <div>
                    <h5>Tags:</h5>
                    <span v-for="tag in article.post_tags">
                        <a :href="tag.link"> {{tag.name}} </a>
                    </span>
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Blog
*/
import blogSingle from './blog/blogSingle.vue';
import {mapActions, mapState} from 'vuex';

export default {
    name: 'blog',
    components:{
        'blog-single': blogSingle
    },
    data() {
        return {
            api: API_ROOT,
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

img {
    width: 128px;
    height: 128px;
}
</style>
