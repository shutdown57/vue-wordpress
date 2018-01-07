<template>
    <div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1>شرکت ایرانیان مگنت</h1>
                <image-loader :src="path"
                              width="600"
                              height="800"
                              class="img-responsive img-rounded"
                              :preview="ASSETS_PATH + '/logo.png'"></image-loader>
                <!-- <img :src="path" alt=""> -->
            </div>
            <div class="col-sm-12 text-center">
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail0"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail1"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail2"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail3"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail4"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail5"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail6"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail7"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Home
*/
import VueImageLoader from 'vue-img-loader';
import {ASSETS_PATH} from '../config';

export default {
    name: 'home',

    components: {
        'image-loader': VueImageLoader
    },

    data() {
        return {
            path: ASSETS_PATH + '/logo.png',
            thumbnail0: ASSETS_PATH + '/home-page/برنامه درسی.png',
            thumbnail1: ASSETS_PATH + '/home-page/تقویم.png',
            thumbnail2: ASSETS_PATH + '/home-page/روی خودرو.png',
            thumbnail3: ASSETS_PATH + '/home-page/قاب عکس.png',
            thumbnail4: ASSETS_PATH + '/home-page/کارت اشتراک.png',
            thumbnail5: ASSETS_PATH + '/home-page/ماژیک.png',
            thumbnail6: ASSETS_PATH + '/home-page/مذهبی.png',
            thumbnail7: ASSETS_PATH + '/home-page/وایت برد.png',
            msg: 'Home'
        };
    },

    methods: {
        loadImage(path) {
            return require(path);
        }
    },

    created() {
        window.document.title = "ایرانیان مگنت";
    }
}
</script>

<style scoped>
img { width: 100% !important; height: 100%; }
</style>
