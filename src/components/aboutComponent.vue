<template>
    <div dir="rtl">
        <h1 class="white">{{ msg }}</h1>
        <h3 class="white">توضیحاتی درباره شرکت ایرانیان مگنت</h3>
        <p class="white">باعث افتخار است که طی سالیان متمادی به عنوان بزرگترین و کارامد ترین مرکز تولیدات مگنت های تبلیغاتی توانسته ایم خدماتی ارزنده را به گروه های صنعتی مختلف ارائه کنیم . گالری محصولات ما تائیدی بر گفته های ما میباشد . بیش از هزاران نمونه کارهای تولید از شرکت ها و موسسات مختلف در سرتاسر کشور ، ما همیشه معتقدیم که مهمترین اصل در بقای سازمان ، تعهد و کیفیت بالای خدمات یا محصولات در کنار قیمتی متفاوت خواهد بود . امید است تا در آینده ایی نزدیک شما هم جزوی از خانواده بزرگ گروه ایرانیان مگنت باشید .</p>
        <!-- Add some images -->
        <div class="row">
            <div class="col-xs-4 col-sm-12 col-md-4">
                <image-loader :src="printer1" height="500"></image-loader>
            </div>
            <div class="col-xs-4 col-sm-12 col-md-4">
                <image-loader :src="printer2" height="500"></image-loader>
            </div>
            <div class="col-xs-4 col-sm-12 col-md-4">
                <image-loader :src="printer3" height="500"></image-loader>
            </div>
        </div>
        <p class="white">این شرکت با داشتن کارگاه و ماشین آلات مجزا و حرفه ای در ضمینه مگنت تولید این محصول را به صورت تخصصی و مطابق با استاندارهای روز دنیا انجام می دهد .این شرکت به واسطه تهیه مواد اولیه جهت تولید این محصول به صورت مستقیم و بدون دخالت واسطه توانسته قیمت تمام شده مگنت تبلیغاتی را به حداقل برساند بدون اینکه از کیفیت محصول کسر گردد .تخصص ما فقط تولید مگنت های تبلیغاتی می باشد و مفتخریم که با بیش از ۳۰۰ برند معروف اعم از صنایع غذائی، شرکتهای تولید لوازم خانگی، شیرینی و شکلات، شبکه های هوشمند اینترنتی، رستورانهای بزرگ و… در ایران و خارج از ایران همکاری داشته ایم.</p>
        <!-- Add some images -->
        <div class="row">
            <div class="col-xs-4 col-sm-12 col-md-4">
                <image-loader :src="printer6" height="500"></image-loader>
            </div>
            <div class="col-xs-4 col-sm-12 col-md-4">
                <image-loader :src="printer4" height="500"></image-loader>
            </div>
            <div class="col-xs-4 col-sm-12 col-md-4">
                <image-loader :src="printer5" height="500"></image-loader>
            </div>
        </div>
        <br>
        <p class="white">شما مشتری گرامی می توانید به راحتی با واحد فروش تماس داشته باشید و تمام سوالات خود پیرامون مگنت های تبلیغاتی را پاسخ بگیرید. همچنین برای اطلاع بیشتر از برخی انواع مگنت های تبلیغاتی به صفحه محصولات مگنتی مراجعه کنید. اگر تمایل دارید تا برخی از نمونه کارهای این شرکت را مشاهده کنید می توانید از طریق صفحه گالری تصاویر نمونه مگنت های تبلیغاتی اقدام کنید.</p>
        <br>
    </div>
</template>

<script>
/**
 * @component: About
*/
import VueImageLoader from 'vue-img-loader';

import {ASSETS_PATH} from '../config';

export default {
    name: 'about',

    components: {
        'image-loader': VueImageLoader
    },

    data() {
        return {
            msg: 'درباره ما',
            pictures: {},
            printer1: ASSETS_PATH + '/About/image-17.png',
            printer2: ASSETS_PATH + '/About/image-20.png',
            printer3: ASSETS_PATH + '/About/image-23.png',
            printer4: ASSETS_PATH + '/About/image-11.png',
            printer5: ASSETS_PATH + '/About/image-25.png',
            printer6: ASSETS_PATH + '/About/image-26.png',
        };
    },

    created() {
        window.document.title = "درباره ما";
    }
}
</script>

<style scoped>
.white { 
    background-color: aliceblue;
    padding-right: 15px;
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 15px;
}
</style>
