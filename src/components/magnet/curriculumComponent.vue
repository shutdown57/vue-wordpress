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
                <div v-for="product in productCurriculum" class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#myModal">
                        <img :src="product" alt="وایت برد مگنتی">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginate -->
    <div v-if="page_list.length > 1">
        <span v-for="item in page_list" class="text-center">
            <button type="button" class="btn btn-primary" @click="loadPage(item)">{{ item }}</button>
        </span>
    </div>

</div>
</template>

<script>
/**
 * @component: Curriculum
 * Category: 84
*/
import { sleep, Base64 } from '../../mixins/utils';
import { PRODUCT_CURRICULUM } from '../../store/staticsCategories.js';
import { BASE_URL } from '../../config';

export default {
    name: 'curriculum',

    data() {
        return {
            num: 0,
            page_list: [],
            img_info: {},
            productCurriculum: [],
            msg: 'نمونه کار‌های برنامه‌درسی',
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            }
        };
    },

    created() {
        window.document.title = 'برنامه درسی مگنتی';
    },

    mounted() {
        this.infiniteHandler();
        this.loadPage();
    },

    methods: {
        loadPage: function(page_number=1) {
            page_number = parseInt(page_number);
            let CATEGORIES_OUT = [83, 85, 86, 87, 88, 89, 90, 91, 92, 1, 61];
            /*****************************************************************************************/
            // Get Posts
            this.$http.get(BASE_URL + "wp-json/wp/v2/posts", {
                params: {
                    categories: PRODUCT_CURRICULUM,
                    categories_exclude: CATEGORIES_OUT,
                    page: page_number,
                    per_page: 10
                }
            }).then(res => {
                /*****************************************************************************/
                    // Get post image
                    res.body.map((cur_img, i_img, arr_img) => {
                        this.productCurriculum.push(cur_img.better_featured_image.source_url);
                    });
            }, rej => { /* $state.complete(); */ });
        },

        infiniteHandler: function($state) {
            this.num += 1;
            /*****************************************************************************************/
            // Get number of posts
            this.$http.get(BASE_URL + "wp-json/wp/v2/categories/" + PRODUCT_CURRICULUM, {
                before: (request) => {
                    request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    request.headers.set('Authorization', 'Basic ' + Base64.encode( 'default:strongPassword1234' ));
                }
            }).then(resolve => {
                let total_page = parseInt(resolve.body.count / 10);
                if (resolve.body.count % 10 > 0) {
                    total_page += 1;
                }
                for (let i = 1; i <= total_page; i++) {
                    this.page_list.push(i);
                }
            }, reject => {});
        }
    }
}
</script>

<style>
.direction-rtl { direction: rtl; }
img { width: 100% !important;}
</style>
