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
                <div v-for="product in productPictureFrame" class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#myModal">
                    <img :src="product.img_info[0].url" alt="قاب عکس مگنتی" v-model="img_info=product.img_info[0]">
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
            <h4 class="modal-title" dir="rtl" id="myModalLabel">{{"قاب عکس مگنتی"}}</h4>
        </div>
        <div class="modal-body text-center">
            <img class="img-responsive" :src="img_info.url" alt="قاب عکس مگنتی">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Infinite Loading -->
    <!-- <div infinite-wrapper>
        <infinite-loading @infinite="infiniteHandler" force-use-infinite-wrapper="true">
            <span slot="no-more">
                <div class="alert alert-warning alert-dismissible" role="alert" dir="rtl">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>توجه!</strong> پست دیگری وجود ندارد.
                </div>
            </span>
        </infinite-loading>
    </div> -->
    {{infiniteHandler()}}
</div>
</template>

<script>
/**
 * @component: Picture Frame
 * Category: 88
 */
import InfiniteLoading from 'vue-infinite-loading';
import {sleep, Base64} from '../../mixins/utils';
import api from '../../api';
import { PRODUCT_PICTURE_FRAME } from '../../store/staticsCategories';
import { BASE_URL, NONCE } from '../../config';

export default {
    name: 'pictureFrame',

    components: {
        InfiniteLoading
    },

    data() {
        return {
            img_info: {},
            token: '',
            counts: true,
            productPictureFrame: [],
            msg: 'نمونه کار‌های قاب عکس',
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            }
        }
    },

    created() {
        window.document.title = 'قاب عکس مگنتی';
    },

    methods: {
        infiniteHandler($state) {
            sleep(2000).then(() => {
                let CATEGORIES_OUT = [83, 84, 85, 86, 87, 89, 90, 91, 92, 1, 61];
                /*****************************************************************************************/
                // Get number of posts
                this.$http.get(BASE_URL + "wp-json/wp/v2/categories/" + PRODUCT_PICTURE_FRAME, {
                            before: (request) => {
                                request.headers.set('X-WP-Nonce', NONCE);
                                request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                                request.headers.set('Authorization', 'Basic ' + Base64.encode( 'default:strongPassword1234'));
                            }
                        }).then(resolve => {
                            this.counts = resolve.body.count;
                        }, reject => {});
                /*****************************************************************************************/
                // Get Posts
                this.$http.get(BASE_URL + "wp-json/wp/v2/posts", {
                    params: {
                        categories: PRODUCT_PICTURE_FRAME,
                        categories_exclude: CATEGORIES_OUT,
                        page: parseInt(this.productPictureFrame.length / 6) + 1,
                        per_page: 6
                    },
                    before: (request) => {
                        request.headers.set('X-WP-Nonce', NONCE);
                        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                        request.headers.set('Authorization', 'Basic ' + Base64.encode( 'default:strongPassword1234'));
                    }
                }).then(res => {
                    if (res.body.length && this.productPictureFrame.length < this.counts) {
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
                                    request.headers.set('X-WP-Nonce', NONCE);
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

                        this.productPictureFrame = [...res.body];
                        $state.loaded();
                        
                        if (this.productPictureFrame.length % 6 == this.counts) {
                            $state.complete();
                        }
                    } else {
                        $state.complete();
                    }
                }, rej => {
                    $state.complete();
                });
            });
        }
    }
}
</script>

<style>
.direction-rtl { direction: rtl; }
img { width: 100% !important;}
</style>