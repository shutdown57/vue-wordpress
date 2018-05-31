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
                            <router-link :to="{name: 'blogSingle', params:{pid: article.id}}" class="text-center">
                                <div v-if="img in article" class="media-right">
                                        <image-loader :width="150" :height="150" :blur-preview="true" :src="article.img.url" class="media-object img-responsive img-rounded"></image-loader>
                                        <!-- <img :src="img_" alt="ایرانیان مگنت" class="media-object img-responsive img-rounded"> -->
                                </div>
                                <div class="media-body">
                                    <h2 class="media-heading text-info">{{ article.title.rendered }}</h2>
                                    <br><br>
                                    <p>
                                        لطفا برای خواندن ادامه مطلب بر روی عکس کلیک کنید
                                    </p>
                                </div>
                            </router-link>
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
 * @component: BlogAll
 * Category: 61
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
import {BASE_URL} from '../../config';
import {default_img} from '../../store/localResources.js';

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
            img_: default_img,
            have_img: false,
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
            let allCategories = [...PRODUCT_CATEGORIES_IN, ...[1, 61]];
            // Remove id from allCategories array
            removeArray(allCategories, id[0]);
            this.$http.get(BASE_URL + "wp-json/wp/v2/posts", {
                params: {
                    categories: id,
                    categories_exclude: allCategories,
                    page: this.list.length / 10 + 1,
                    per_page: 10
                }
            }).then(res => {
                if (res.body.length){
                    // Fetch image info from the server
                    res.body.map((cur_main, i_main, val_main) => {

                        if (cur_main.featured_media != 0) {
                            cur_main.img = [];
                            api.getMediaId(cur_main.featured_media).then((resolve) => {
                                cur_main.img.push({
                                    title: resolve.body.title.rendered,
                                    url: resolve.body.source_url
                                });
                            }, (reject) => {
                                this.alert_msg.have = true;
                                this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                                this.alert_msg.type = 'alert-danger';
                            });
                        }

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
                    });
                    this.list = this.list.concat(res.body);
                    $state.loaded();
                    if (this.list.length % 10 === 10) {
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            }, rej => { $state.complete(); }
            );
        }
    }
}
</script>

<style scoped>
.direction-rtl{
    direction: rtl;
}
</style>
