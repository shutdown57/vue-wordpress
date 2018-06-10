<template>
<div class="direction-rtl">
    <div v-if="num < 1">{{infiniteHandler()}} {{loadPage(1)}}</div>
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
                    <img :src="product.img_info[0].url" alt="ماژیک مگنتی" v-model="img_info=product.img_info[0]">
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
            <h4 class="modal-title" dir="rtl" id="myModalLabel">{{"ماژیک مگنتی"}}</h4>
        </div>
        <div class="modal-body text-center">
            <img class="img-responsive" :src="img_info.url" alt="ماژیک مگنتی">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
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
 * @component: Marker
 * Category: 86
 */
import InfiniteLoading from 'vue-infinite-loading';
import {sleep, Base64} from '../../mixins/utils';
import api from '../../api';
import {PRODUCT_MARKER} from '../../store/staticsCategories';
import {BASE_URL, NONCE} from '../../config';

export default {
    name: 'marker',

    data() {
        return {
            num: 0,
            page_list: [],
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
        loadPage: function(page_number) {
            page_number = parseInt(page_number);
            let CATEGORIES_OUT = [83, 84, 85, 87, 88, 89, 90, 91, 92, 1, 61];
            /*****************************************************************************************/
            // Get Posts
            this.$http.get(BASE_URL + "wp-json/wp/v2/posts", {
                params: {
                    categories: PRODUCT_MARKER,
                    categories_exclude: CATEGORIES_OUT,
                    page: page_number,
                    per_page: 10
                },
                before: (request) => {
                    request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    request.headers.set('Authorization', 'Basic ' + Base64.encode( 'default:strongPassword1234' ));
                }
            }).then(res => {
                    res.body.map((cur_img, i_img, arr_img) => {
                        cur_img.img_info = [];
                        /*****************************************************************************/
                        // Get post image
                        this.$http.get(BASE_URL + "wp-json/info/v1/post",
                        {
                            params: {
                                post_id: cur_img.id
                            },
                            before: (request) => {
                                request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                                request.headers.set('Authorization', 'Basic ' + Base64.encode( 'default:strongPassword1234'));
                            }
                        }).then(resp => {
                            cur_img.img_info.push({
                                url: resp.body.url
                            });
                        }, reject => {
                            this.alert_msg.have = true;
                            this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                            this.alert_msg.type = 'alert-danger';
                        });
                    });

                    this.productMarker = res.body.copyWithin();
            }, rej => { /* $state.complete(); */ });
        },

        infiniteHandler: function($state) {
            this.num += 1;
            sleep(2000).then(() => {
                /*****************************************************************************************/
                // Get number of posts
                this.$http.get(BASE_URL + "wp-json/wp/v2/categories/" + PRODUCT_MARKER, {
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
            });
        }
    },

    created() {
        window.document.title = 'انواع ماژیک مگنتی';
    }
}
</script>

<style>
.direction-rtl { direction: rtl; }
img { width: 100% !important;}
</style>