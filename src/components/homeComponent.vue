<template>
    <div>
        <div>
            <h1 class="text-center">شرکت ایرانیان مگنت</h1>
            <div class="row slider-bg">
                <div class="col-sm-12">
                    <carousel-3d :autoplay="true" :autoplay-timeout="3000" :display="5" :width="300" :height="200">
                        <slide class="slides" v-for="(brand, index) in brands" :index="index">
                            <img :src="brand">
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
                        <div v-for="thumbnail in thumbnails" class="col-xs-6 col-md-3">
                            <router-link :to="thumbnail.linkObject">
                                <image-loader :src="thumbnail.path"
                                        width="200"
                                        height="300"
                                        class="img-rounded img-responsive">
                                </image-loader>
                            </router-link>
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
            thumbnails: {
                curriculum: {
                    path: ASSETS_PATH + '/home-page/برنامه درسی.png',
                    linkObject: {
                        name: 'curriculum'
                    }
                },
                calendar: {
                    path: ASSETS_PATH + '/home-page/تقویم.png',
                    linkObject: {
                        name: 'calendar'
                    }
                },
                onCar: {
                    path: ASSETS_PATH + '/home-page/روی خودرو.png',
                    linkObject: {
                        name: 'onCar'
                    }
                },
                pictureFrame: {
                    path: ASSETS_PATH + '/home-page/قاب عکس.png',
                    linkObject: {
                        name: 'pictureFrame'
                    }
                },
                subscribeCard: {
                    path: ASSETS_PATH + '/home-page/کارت اشتراک.png',
                    linkObject: {
                        name: 'subscribCard'
                    }
                },
                marker: {
                    path: ASSETS_PATH + '/home-page/ماژیک.png',
                    linkObject: {
                        name: 'marker'
                    }
                },
                religion: {
                    path: ASSETS_PATH + '/home-page/مذهبی.png',
                    linkObject: {
                        name: 'religion'
                    }
                },
                whiteBoard: {
                    path: ASSETS_PATH + '/home-page/وایت برد.png',
                    linkObject: {
                        name: 'whiteBoard'
                    }
                }
            },
            
            msg: 'Home',

            progress: {
                img1: {
                    title: 'مشاوره',
                    path: ASSETS_PATH + '/home-page/مشاوره.png',
                    alt: 'مشاوره',
                    description: 'مشاوره به صورت کاملا رایگان و در تمامی زمینه‌های تبلیغاتی'
                },
                
                img2: {
                    title: 'عکاسی',
                    path: ASSETS_PATH + '/home-page/عکاسی.png',
                    alt: 'آتلیه عکاسی',
                    description: 'تیم عکاسی مجرب مجهز به آتلیه همراه, آماده همکاری'
                },
                
                img3: {
                    title: 'طراحی',
                    path: ASSETS_PATH + '/home-page/طراحی.png',
                    alt: 'طراحان مجرب',
                    description: 'طراحان ما در با سابقه بیش از ۱۰ سال در زمینه طراحی انواع مگنت'
                },
                
                img4: {
                    title: 'چاپ',
                    path: ASSETS_PATH + '/home-page/چاپ.png',
                    alt: 'چاپ افست',
                    description: 'چاپ توسط دستگاه‌های افست چهار رنگ انجام میشود.'
                },
            },

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
.slider-bg { background-color: #e0cf55; }
.head-3 {
    background-color: #e0cf55;
    padding-top: 12px;
    padding-bottom: 10px;
    padding-left: 5px;
    padding-right: 5px;
 }
</style>
