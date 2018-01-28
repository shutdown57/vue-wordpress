<template>
    <div>
        <div v-if="alert_msg.have" class="alert text-center" :class="alert_msg.type" role="alert">
            {{ alert_msg.msg }}
        </div>
        <h1 dir="rtl">{{ msg }}</h1>
        <div class="row">
            <div class="col-xs-12 col-md-6" v-for="article in list">
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
        <infinite-loading @infinite="infiniteHandler">
            <span slot="no-more">
                <div class="alert alert-warning alert-dismissible" role="alert" dir="rtl">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>توجه!</strong> پست دیگری وجود ندارد.
                </div>
            </span>
        </infinite-loading>
    </div>
</template>

<script>
/**
*   @component: BlogAll
*/
import {mapState, mapActions} from 'vuex';
import VueImageLoader from 'vue-img-loader';
import InfiniteLoading from 'vue-infinite-loading';

import api from '../../api';
import {
    BLOG_CATEGORY,
    PRODUCT_CATEGORIES_IN
} from '../../store/staticsCategories';
import {removeArray, addArray} from '../../mixins/utils';

export default {
    name: 'blogAll',

    components: {
        'image-loader': VueImageLoader,
        InfiniteLoading
    },

    data() {
        return {
            list: [],
            msg: 'اخبار ایرانیان مگنت',
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            }
        };
    },

    created() {
        window.document.title = "اخبار";
    },

    methods: {
        infiniteHandler($state) {
            let id = [...BLOG_CATEGORY];
            // Convert id to number and push it to an array
            id = addArray(parseInt(id));
            let allCategories = [...PRODUCT_CATEGORIES_IN, ...[1, 2, 17]];
            // Remove id from allCategories array
            removeArray(allCategories, id[0]);
            this.$http.get("http://wordpress.app/wp-json/wp/v2/posts", {
                params: {
                    categories: id,
                    categories_exclude: allCategories,
                    page: this.list.length / 10 + 1
                }
            }).then(res => {
                if (res.body.length){
                    // Fetch image info from the server
                    res.body.map((cur_main, i_main, val_main) => {
                        // Thumbnail Handling
                        cur_main.img_info = [];
                        api.getMediaId(cur_main.featured_media).then(resolve =>{
                            // Thumbnail url and title
                            cur_main.img_info.push({
                                img_url: resolve.body.source_url,
                                img_title: resolve.body.title.rendered
                            });
                        }, (reject) => {
                            cur_main.featured_media = cur_main.featured_media;
                        });

                        // Categories Handling
                        cur_main.cats = [];
                        api.getCategoriesId(cur_main.categories).then((resolve) => {
                            cur_main.cats.push({
                                name: resolve.body.name,
                                link: resolve.body.link
                            });
                        }, (reject) => {
                            this.alert_msg.have = true;
                            this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                            this.alert_msg.type = 'alert-danger';
                        });

                        // Tags Handling
                        cur_main.post_tags = [];
                        cur_main.tags.map((cur_tag, i_tag, val_tag) => {
                            api.getTagsId(cur_tag).then((resolve) => {
                                cur_main.post_tags.push({
                                    name: resolve.body.name,
                                    link: resolve.body.link
                                });
                            }, (reject) => {
                                this.alert_msg.have = true;
                                this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                                this.alert_msg.type = 'alert-danger';
                            });
                        });

                    });
                    this.list = this.list.concat(res.body);
                    $state.loaded();
                    if (!(this.list.length % 10 === 0)) {
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            }, rej => {
                
                $state.complete();
            });
        }
    }
}
</script>

<style scoped>
.direction-rtl{
    direction: rtl;
}
</style>
