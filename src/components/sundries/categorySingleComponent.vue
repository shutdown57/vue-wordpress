<template>
    <div>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-center">دسته‌بندی <strong>{{category.name}}</strong></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3" v-for="post in posts">
                        <div class="thumbnail">
                            <img :src="post.img_info.url" :alt="post.img_info.title" class="img-responsive img-rounded">
                            <div dir="rtl" class="caption">
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
 * @component: Single Category
 */
import api from '../../api';

export default {
    name: 'categorySingle',

    watch: {
        '$route': 'initParam'
    },

    methods: {
        initParam() {
            const cid = this.$route.params.cid;
            return cid;
        }
    },

    data() {
        return {
            posts: [],
            category: {}
        };
    },

    created() {
        window.document.title = 'دسته‌بندی';
        let id = this.initParam();
        api.getCategoriesId(id)
            .then(res => {
                // console.log(res);
                this.category = res.body;
                window.document.title = 'دسته‌بندی' + ' ' + this.category.name;
            }, rej => { console.error(rej); });
        api.getPostsByCategory(id)
            .then(res => {
                // console.log(res);

                // Get information for every single post
                res.body.map((cur_post, i_post, arr_post) => {
                    cur_post.img_info = {};

                    // Handling Thumbnail
                    api.getMediaId(cur_post.featured_media)
                        .then(resolve => {
                            // console.log(resolve);
                            cur_post.img_info.title = resolve.body.title.rendered;
                            cur_post.img_info.url = resolve.body.source_url;
                        }, reject => { console.error(reject); });
                });
                this.posts = res.body;
            }, rej => { console.error(rej); });
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
