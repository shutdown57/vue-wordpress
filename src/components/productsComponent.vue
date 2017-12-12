<template>
    <div class="panel panel-primary direction-rtl">
       <div class="panel-heading">
           <h1 class="text-center">{{msg}}</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div v-for="product in productList" class="col-sm-12 col-md-6 col-lg-4">
                    <div class="thumbnail">
                        <img :src="product.img_info[0].url" :alt="product.img_info[0].title">
                        <div class="caption">
                            <h3>{{product.title.rendered}}</h3>
                            <router-link class="btn btn-block btn-success" :to="{name: 'productSingle', params: {id: product.categories[0]}}">{{product.title.rendered}}</router-link>
                        </div>
                    </div>
                </div>
            </div>
       </div>
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
 * @component: Products
*/
import InfiniteLoading from 'vue-infinite-loading';

import api from '../api';
import {
    PRODUCT_CATEGORIES_IN, PRODUCT_CATEGORIES_OUT
} from '../store/staticsCategories';


export default {
    name: 'products',

    components: {
        InfiniteLoading
    },
    
    data() {
        return {
            productList: [],
            msg: 'محصولات'
        };
    },

    created() {
        window.document.title = 'محصولات';
        // api.getPostsAll(PRODUCT_CATEGORIES_IN, PRODUCT_CATEGORIES_OUT)
        //     .then(res => {
        //         if (!res.ok) {
        //             this.msg = 'مشکل در ارتباط با سرور';
        //         }
                
        //         // Handling Thumbnail
        //         res.body.map((cur_img, i_img, arr_img) => {
        //             cur_img.img_info = [];
        //             api.getMediaId(cur_img.featured_media)
        //                 .then(resolve => {
        //                     // console.log(resolve);
        //                     cur_img.img_info.push({
        //                         title: resolve.body.title.rendered,
        //                         url: resolve.body.source_url
        //                     });
        //                     // cur_img.img_info.title = resolve.body.title.rendered;
        //                     // cur_img.img_info.url = resolve.body.source_url
        //                 }, reject => { /*console.error(reject);*/ });
        //         });
        //         this.productList = res.body;
        //         // console.log(this.productList);
        //     }, rej => {
        //         console.error(rej);
        //     });
    },

    methods: {
        infiniteHandler($state) {
            this.$http.get("http://wordpress.app/wp-json/wp/v2/posts", {
                params: {
                    categories: PRODUCT_CATEGORIES_IN,
                    categories_exclude: PRODUCT_CATEGORIES_OUT,
                    page: this.productList.length / 10 + 1,
                    per_page: 6
                }
            }).then(res => {
                if (res.body.length) {
                    // Handling Thumbnail
                    res.body.map((cur_img, i_img, arr_img) => {
                        cur_img.img_info = [];
                        api.getMediaId(cur_img.featured_media)
                            .then(resolve => {
                                // console.log(resolve);
                                cur_img.img_info.push({
                                    title: resolve.body.title.rendered,
                                    url: resolve.body.source_url
                                });
                                // cur_img.img_info.title = resolve.body.title.rendered;
                                // cur_img.img_info.url = resolve.body.source_url
                            }, reject => { /*console.error(reject);*/ });
                    });
                    this.productList = this.productList.concat(res.body);
                    console.log(this.productList);
                    console.log(res.body)
                    $state.loaded();
                    if (this.productList.length % 10 === 0) {
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            }, rej => {
                // console.log(rej);
                $state.complete();
            });
        }
    }
}
</script>

<style scoped>
.direction-rtl { direction: rtl; }
button > a { color: aliceblue; }
</style>
