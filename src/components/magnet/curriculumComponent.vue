<template>
  <div class="direction-rtl">
      <h1>{{msg}}</h1>
  </div>
</template>

<script>
/**
 * @component: Curriculum
*/
import api from '../../api';
import { PRODUCT_CURRICULUM } from '../../store/staticsCategories.js';

export default {
    name: 'curriculum',
    data() {
        return {
            productCurriculum: [],
            msg: 'نمونه کار‌های برنامه‌درسی'
        };
    },

    created() {
        window.document.title = 'برنامه درسی';
        let CATEGORIES_OUT = [1, 2, 7, 6];
        api.getPostsAll(PRODUCT_CURRICULUM, CATEGORIES_OUT)
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
                        }, reject => {});
                });
                this.productCurriculum = res.body;
                console.log(this.productCurriculum);
            }, rej => { console.log(rej); });
    }
}
</script>

<style>
.direction-rtl { direction: rtl; }
</style>
