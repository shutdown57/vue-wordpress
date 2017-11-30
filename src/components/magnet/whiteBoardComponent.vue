<template>
<div class="direction-rtl">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{msg}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div v-for="product in productWhiteBoard" class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#myModal">
                    <img :src="product.img_info[0].url" :alt="product.img_info[0].title" v-model="img_info=product.img_info[0]">
                    </a>
                </div>
            </div>
        </div>
    </div>
        
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
</template>

<script>
/**
 * @component: White Board
 */
import api from '../../api';
import {PRODUCT_WHITEBOURD} from '../../store/staticsCategories';

export default {
    name: 'whiteBoard',
    data() {
        return {
            productWhiteBoard: [],
            msg: 'نمونه کار‌های وایت برد'
        }
    },

    created() {
        window.document.title = 'وایت برد مگنتی';

        let CATEGORIES_OUT = [1, 2, 7, 5];
        api.getPostsAll(PRODUCT_WHITEBOURD, CATEGORIES_OUT)
            .then(res => {
                if (!res.ok) {
                    this.msg = 'مشکل در ارتباط با سرور';
                }

                // Handling Thumbnail
                res.body.map((cur_img, i_img, arr_img) => {
                    cur_img.img_info = [];
                    api.getMediaId(cur_img.featured_media)
                        .then(resolve => {
                            cur_img.img_info.push({
                                url: resolve.body.source_url,
                                title: resolve.body.title.rendered
                            });
                        }, reject => { /*console.error(reject);*/ });
                });
                this.productWhiteBoard = res.body;
            }, rej => { /*console.error(reject);*/ });
    }
}
</script>

<style>

</style>
