<template>
    <div>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-center">نام برچسب <strong>{{tag.name}}</strong></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div v-for="post in posts" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <img class="img-responsive img-rounded" :src="post.img_info.url" :alt="post.img_info.title">
                            <div class="caption" dir="rtl">
                                <h3>{{post.title.rendered}}</h3>
                                <div v-if="post.content.rendered.length > 1">
                                    <p v-html="post.content.rendered"></p>
                                    <router-link class="btn btn-block btn-info" :to="{name: 'blogSingle', params: {pid: post.id}}">ادامه مطلب</router-link>
                                </div>
                                <div v-else>
                                    <a href="#" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal" v-model="img_info = post.img_info">مشاهده محصول</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" dir="rtl" id="myModalLabel">{{img_info.title}}</h4>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img class="img-responsive" :src="img_info.url" :alt="img_info.title">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Tag Single
 */
import api from '../../api';

export default {
    name: 'tagSingle',

    watch: {
        '$route': 'initParam'
    },

    methods: {
        initParam() {
            const tid = this.$route.params.tid;
            return tid;
        }
    },

    data() {
        return {
            posts: [],
            tag: {}
        };
    },

    created() {
        window.document.title = '';
        let id = this.initParam();
        api.getTagsId(id)
            .then(res => {
                this.tag = res.body;

                // Get Posts Details
                api.getPostsByTagId(id)
                    .then(resolve => {
                        this.posts = resolve.body;
                        window.document.title = 'برچسب ' + this.tag.name;

                        // Get Informations for every single post
                        resolve.body.map((cur_post, i_post, arr_post) => {
                            cur_post.cats = [];
                            cur_post.img_info = {};
                            // console.log(cur_post);

                            // Handling Categories
                            api.getCategoriesId(cur_post.categories)
                                .then(res_cat => {
                                    // console.log(res_cat);
                                    cur_post.cats.push({
                                        name: res_cat.body.name,
                                        id: res_cat.body.id
                                    });
                                }, rej_cat => { console.log(rej_cat); });
                            
                            // Handling Thumbnail
                            api.getMediaId(cur_post.featured_media)
                                .then(res_img => {
                                    // console.log(res_img);
                                    cur_post.img_info.title = res_img.body.title.rendered;
                                    cur_post.img_info.url = res_img.body.source_url;
                                }, rej_img => { console.log(res_img); });
                        });

                        this.posts = resolve.body;
                        console.log(this.posts);
                    }, reject => { console.log(reject); });
            }, rej => { console.log(rej); });
    }
}
</script>

<style>
img {
    width: 100% !important;
    height: 200px;
}
button > a { color: aliceblue; }
</style>
