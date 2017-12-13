<template>
<div class="direction-rtl">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{msg.title.rendered}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div v-for="product in products" class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#myModal">
                    <img :src="product.img_info[0].url" :alt="product.img_info[0].title" v-model="img_info=product.img_info[0]">
                    </a>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" v-if="img_info">
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
    
    <!-- Infinite Loading -->
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
 * @component: Product Single
 */
import InfinteLoading from 'vue-infinite-loading';

import api from '../../api';
import {PRODUCT_CATEGORIES_IN} from '../../store/staticsCategories';
import {removeArray, addArray} from '../../mixins/utils';

export default {
    name: 'productSingle',
    
    watch: {
        '$route': 'initParam'
    },

    methods: {
        initParam() {
            const pid = this.$route.params.id;
            return pid;
        }
    },
    
    data() {
        return {
            img_info: {},
            products: [],
            msg: {}
        };
    },
// TODO: Conver created to a function like infiniteHandler
    created() {
        let id = this.initParam();
        // Convert id to number and push it to an array
        id = addArray(parseInt(id));
        let allCategories = [...PRODUCT_CATEGORIES_IN, ...[1, 2, 17]];
        // Remove id from allCategories array
        removeArray(allCategories, id[0]);
        // console.log(allCategories);
        // console.log(id);
        api.getPostsAll(id, allCategories)
            .then(res => {
                // console.log(res);
                
                // Handling Thumbnail
                res.body.map((cur_post, i_post, arr_post) => {
                    cur_post.img_info = [];
                    api.getMediaId(cur_post.featured_media)
                        .then(resolve => {
                            cur_post.img_info.push({
                                url: resolve.body.source_url,
                                title: resolve.body.title.rendered
                            });
                        }, reject => { /*console.log(reject);*/ });
                this.products = res.body;
                this.msg = {...this.products[0]};
                });
            }, rej => { /*console.error(rej);*/ });
    },

    methods: {
        infiniteHandler($state) {
            let id = this.initParam();
            // Convert id to number and push it to an array
            id = addArray(parseInt(id));
            let allCategories = [...PRODUCT_CATEGORIES_IN, ...[1, 2, 17]];
            // Remove id from allCategories array
            removeArray(allCategories, id[0]);
            this.$http.get("http://wordpress.app/wp-json/wp/v2/posts", {
                params: {
                    categories: id,
                    categories_exclude: allCategories,
                    page: this.products.length / 10 + 1,
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
                            }, reject => { /*console.error(reject);*/ });
                    });
                    this.products = this.products.concat(res.body);
                    console.log(this.products);
                    $state.loaded();
                    if (this.products.length % 10 === 0) {
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

<style>

</style>
