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
                    <div v-for="thumbnail in thumbnails" class="col-xs-6 col-md-3">
                        <image-loader :src="thumbnail"
                                width="200"
                                height="300"
                                class="img-rounded img-responsive"
                                ></image-loader>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12  thumbnail-bg">
                <h4 class="text-center">برخی از مشتریان ما</h4>
                <carousel-3d :autoplay="true" :autoplay-timeout="3000" :display="3"
                        :width="300" :height="200">
                    <slide class="slides" v-for="(brand, index) in brands" :index="index">
                        <img :src="brand">
                    </slide>
                </carousel-3d>
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
            brands: [
                ASSETS_PATH + '/brands/Ab-o-Fazelab.png',
                ASSETS_PATH + '/brands/bamilo.png',
                ASSETS_PATH + '/brands/Bosch.png',
                ASSETS_PATH + '/brands/Butane.png',
                ASSETS_PATH + '/brands/daewoo.png',
                ASSETS_PATH + '/brands/daland.png',
                ASSETS_PATH + '/brands/Delpazir.png',
                ASSETS_PATH + '/brands/Deo.png',
                ASSETS_PATH + '/brands/Draje.png',
                ASSETS_PATH + '/brands/fda.png',
                ASSETS_PATH + '/brands/hamrah-aval.png',
                ASSETS_PATH + '/brands/Iran-Insurance.png',
                ASSETS_PATH + '/brands/iran-khodro.png',
                ASSETS_PATH + '/brands/iranradiator.png',
                ASSETS_PATH + '/brands/isoco.png',
                ASSETS_PATH + '/brands/Kourosh.png',
                ASSETS_PATH + '/brands/lg.png',
                ASSETS_PATH + '/brands/Majid-Logo.png',
                ASSETS_PATH + '/brands/mihan.png',
                ASSETS_PATH + '/brands/mokhaberat.png',
                ASSETS_PATH + '/brands/Nestle-waterLogo.png',
                ASSETS_PATH + '/brands/novin.png',
                ASSETS_PATH + '/brands/Oghaf.png',
                ASSETS_PATH + '/brands/pegah.png',
                ASSETS_PATH + '/brands/Rahvar.png',
                ASSETS_PATH + '/brands/samsung.png',
                ASSETS_PATH + '/brands/shahrdari-tehran.png',
                ASSETS_PATH + '/brands/shahrvand.png',
                ASSETS_PATH + '/brands/snowa.png',
                ASSETS_PATH + '/brands/Sunstar(FA)Logo.png',
                ASSETS_PATH + '/brands/Taje.png'
            ],
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
.thumbnail-bg { background-color: black; color: azure; }
</style>
