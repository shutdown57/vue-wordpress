<template>
<div class="direction-rtl">
    <div v-if="alert_msg.have" class="alert text-center" :class="alert_msg.type" role="alert">
        {{ alert_msg.msg }}
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{msg}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div v-for="product in productMarker" class="col-xs-6 col-md-3">
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
 * @component: White Board
 */
import InfiniteLoading from 'vue-infinite-loading';

import api from '../../api';
import {PRODUCT_WHITEBOURD} from '../../store/staticsCategories';

export default {
    name: 'marker',

    components: {
        InfiniteLoading
    },

    data() {
        return {
            img_info: {},
            productMarker: [],
            msg: 'نمونه کار‌های ماژیک',
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            }
        }
    },

    methods: {
        infiniteHandler($state) {
            let CATEGORIES_OUT = [1, 2, 7, 5, 11, 16, 15, 10, 12, 13];
            this.$http.get("http://wordpress.app/wp-json/wp/v2/posts", {
                params: {
                    categories: PRODUCT_CALENDAR,
                    categories_exclude: CATEGORIES_OUT,
                    page: this.productMarker.length / 6 + 1,
                    per_page: 6
                }
            }).then(res => {
                if (res.body.length) {
                    res.body.map((cur_img, i_img, arr_img) => {
                        cur_img.img_info = [];
                        api.getMediaId(cur_img.featured_media)
                            .then(resolve => {
                                cur_img.img_info.push({
                                    title: resolve.body.title.rendered,
                                    url: resolve.body.source_url
                                });
                            }, reject => { 
                                this.alert_msg.have = true;
                                this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                                this.alert_msg.type = 'alert-danger';
                             });
                    });
                    this.productMarker = this.productMarker.concat(res.body);
                    $state.loaded();
                    if (this.productMarker.length % 6 == 10) {
                        $state.complete();
                    }
                } else {
                    $state.complete();
                }
            }, rej => {
                $state.complete();
            });
        }
    },

    created() {
        window.document.title = 'انواع ماژیک مگنتی';
    }
}
</script>

<style>

</style>