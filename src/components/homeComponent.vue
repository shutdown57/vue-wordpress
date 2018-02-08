<template>
    <div>
        <div>
            <h1 class="text-center">شرکت ایرانیان مگنت</h1>
            <div class="row gold">
                <div class="col-sm-12">
                    <carousel-3d :autoplay="true" :autoplay-timeout="2000" :display="5" :width="300" :height="200">
                        <slide class="slides" v-for="(item, index) in lastMagnets" :index="index">
                            <img :src="item.path" :alt="item.alt">
                        </slide>
                    </carousel-3d>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <image-loader :src="path"
                                width="600"
                                height="800"
                                class="img-responsive img-rounded"
                                :preview="ASSETS_PATH + '/logo.png'">
                    </image-loader>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-3" v-for="item in progress">
                            <div class="thumbnail">
                                <img :src="item.path" :alt="item.alt">
                                <div class="caption">
                                    <h3 class="text-center">{{item.title}}</h3>
                                    <p dir="rtl">{{item.description}}<br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    <div class="row">
                        <h2 class="text-center head-3">برخی از نمونه‌ کارها</h2>
                        <br>
                        <div class="row">
                            <div v-for="thumbnail in thumbnails1" class="col-xs-6 col-md-3">
                                <router-link :to="thumbnail.linkObject">
                                    <div class="thumbnail gold">
                                        <img :src="thumbnail.path" class="thumbs img-responsive">
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div v-for="thumbnail in thumbnails2" class="col-xs-6 col-md-3">
                                <router-link :to="thumbnail.linkObject">
                                    <div class="thumbnail gold">
                                        <img :src="thumbnail.path" class="thumbs img-responsive">
                                    </div>
                                </router-link>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gold">
                <div class="col-sm-12">
                    <carousel-3d :autoplay="true" :autoplay-timeout="2000" :display="5" :width="300" :height="200">
                        <slide class="slides" v-for="(brand, index) in brands" :index="index">
                            <img :src="brand">
                        </slide>
                    </carousel-3d>
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
import {
    lastMagnets,
    thumbnails1,
    thumbnails2,
    progress,
    brands
} from '../store/localResources';
import api from '../api';

export default {
    name: 'home',

    methods: {
        loadImage(path) {
            return require(path);
        }
    },

    components: {
        'image-loader': VueImageLoader
    },

    data() {
        return {
            lastMagnets: [...lastMagnets],

            path: ASSETS_PATH + '/logo.png',

            thumbnails1: {...thumbnails1},

            thumbnails2: {...thumbnails2},
            
            msg: 'Home',

            progress: {...progress},

            brands: [...brands],
        };
    },

    created() {
        window.document.title = "ایرانیان مگنت";
    }
}
</script>

<style scoped>
.gold { background-color: #f5f11d3b; }
img { width: 100% !important; height: 100% !important; }
.slides { background-color: aliceblue; }
.slider-bg { background-color: #e0cf55; }
.thumbs {
    padding-right: 5px;
    padding-left: 5px;
}
.head-3 {
    background-color: #e0cf55;
    padding-top: 12px;
    padding-bottom: 10px;
    padding-left: 5px;
    padding-right: 5px;
 }
</style>
