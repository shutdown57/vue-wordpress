<template>
<div class="direction-rtl">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{msg}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div v-for="product in productPictureFrame" class="col-xs-6 col-md-3">
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
    name: 'pictureFrame',

    components: {
        InfiniteLoading
    },

    data() {
        return {
            img_info: {},
            productPictureFrame: [],
            msg: 'نمونه کار‌های قال عکس'
        }
    },

    created() {
        window.document.title = 'قاب عکس مگنتی';
    },

    methods: {
        infiniteHandler($state) {
            let CATEGORIES_OUT = [1, 2, 7, 5, 11, 16, 15, 14, 12, 13];
            this.$http.get("http://wordpress.app/wp-json/wp/v2/posts", {
                params: {
                    categories: PRODUCT_CALENDAR,
                    categories_exclude: CATEGORIES_OUT,
                    page: this.productCalendar.length / 10 + 1,
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
                    this.productCalendar = this.productCalendar.concat(res.body);
                    console.log(this.productCalendar);
                    $state.loaded();
                    if (this.productCalendar.length % 10 === 0) {
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