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
                            <button class="btn btn-block btn-success">
                                <router-link :to="{name: 'products', param: {id: product.categories}}">{{product.title.rendered}}</router-link>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</template>

<script>
/**
 * @component: Products
*/
// TODO make page instead post for products page
import api from '../api';
import {
    PRODUCT_CATEGORIES_IN, PRODUCT_CATEGORIES_OUT
} from '../store/staticsCategories';


export default {
    name: 'products',
    
    data() {
        return {
            productList: [],
            msg: 'محصولات'
        };
    },

    created() {
        window.document.title = 'محصولات';
        api.getPostsAll(PRODUCT_CATEGORIES_IN, PRODUCT_CATEGORIES_OUT)
            .then(res => {
                if (!res.ok) {
                    this.msg = 'مشکل در ارتباط با سرور';
                }
                // console.log(res);
                
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
                this.productList = res.body;
            }, rej => {
                console.error(rej);
            });
    }
}
</script>

<style scoped>
.direction-rtl { direction: rtl; }
button > a { color: aliceblue; }
</style>
