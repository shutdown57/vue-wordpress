<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>شرکت ایرانیان مگنت</h1>
                    <image-loader :src="path"
                                width="600"
                                height="800"
                                class="img-responsive img-rounded"
                                :preview="ASSETS_PATH + '/logo.png'">
                    </image-loader>
                </div>
                <div class="col-sm-12 text-center">
                    <div class="row">
                        <div v-for="thumbnail in thumbnails" class="col-xs-6 col-md-3">
                            <image-loader :src="thumbnail"
                                    width="200"
                                    height="300"
                                    class="img-rounded img-responsive"
                                    >
                            </image-loader>
                        </div> 
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
            thumbnails: [
                ASSETS_PATH + '/home-page/برنامه درسی.png',
                ASSETS_PATH + '/home-page/تقویم.png',
                ASSETS_PATH + '/home-page/روی خودرو.png',
                ASSETS_PATH + '/home-page/قاب عکس.png',
                ASSETS_PATH + '/home-page/کارت اشتراک.png',
                ASSETS_PATH + '/home-page/ماژیک.png',
                ASSETS_PATH + '/home-page/مذهبی.png',
                ASSETS_PATH + '/home-page/وایت برد.png',
            ],
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
.slides { background-color: aliceblue; }
</style>
