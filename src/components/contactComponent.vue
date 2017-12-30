<template>
    <div>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">توضیحات</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">تصاویر</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">شبکه‌های اجتماعی</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" dir="rtl">
            <!-- Info tab -->
            <div role="tabpanel" class="tab-pane active" id="home">
                <br>
                <h3>نشانی شرکت</h3>
                <address>
                    <strong><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></strong><br>
                    <abbr title="Address">تهران, میدان امام حسین, خیابان مازندران, پلاک ۶۵, طبقه اول, واحد ۵</abbr>
                </address>
                <hr>
                <h3>تلفن‌های تماس</h3>
                <address>
                    <strong><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></strong><br>
                    <abbr title="Phone" dir="ltr">۰۲۱-۷۵۸۵۴</abbr><br>
                    <abbr title="Phone" dir="ltr">۰۲۱-۷۷۶۸۱۴۰۰-۱</abbr>
                </address>
                <google-map></google-map>
            </div><!-- Info tab -->

            <!-- Video tab -->
            <div role="tabpanel" class="tab-pane" id="profile">
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="embed-responsive embed-responsive-16by9 h_iframe-aparat_embed_frame">
                            <span style="video-embed"></span><iframe class="embed-responsive-item" src="https://www.aparat.com/video/video/embed/videohash/MhCaN/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="embed-responsive embed-responsive-16by9 h_iframe-aparat_embed_frame">
                            <span style="video-embed"></span><iframe class="embed-responsive-item" src="https://www.aparat.com/video/video/embed/videohash/ukpGP/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" ></iframe>
                        </div>
                    </div>
                </div>
                <br>
                <!-- <div class="row">
                    <div class="col-sm-12 col-md-offset-3">
                        <div class="embed-responsive embed-responsive-16by9 h_iframe-aparat_embed_frame">
                            <span style="video-embed"></span><iframe class="embed-responsive-item" src="https://www.aparat.com/video/video/embed/videohash/1OXhe/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" ></iframe>
                        </div>
                    </div>
                </div> -->
            </div><!-- Video tab -->

            <div role="tabpanel" class="tab-pane" id="messages">
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <h3>ما را در شبکه‌های اجتماعی دنبال کنید</h3>
                        <p>در زیر شبکه‌های اجتماعی که شرکت <strong>ایرانیان مگنت</strong> در آنها عضو است موجود میباشد.</p>
                        <p>از بین شبکه‌های زیر اینستاگرام و تلگرام به دلیل فعالیت بیشتر ایرانیان بیشتر پیشنهاد میشود.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-1 col-xs-offset-1">
                        <img :src="socials.svg.instagram" :onerror="socials.png.instagram">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.facebook" :onerror="socials.png.facebook">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.googlePluse" :onerror="socials.png.googlePluse">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.linkedin" :onerror="socials.png.linkedin">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.pinterest" :onerror="socials.png.pinterest">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.skype" :onerror="socials.png.skype">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.telegram" :onerror="socials.png.telegram">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.twitter" :onerror="socials.png.twitter">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.whatsapp" :onerror="socials.png.whatsapp">
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <img :src="socials.svg.youtube">
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">...</div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Contact
*/
import GoogleMaps from './layouts/googleMapsComponent.vue';
import {ASSETS_PATH} from '../config';

export default {
    name: 'contact',
    components: {
        'google-map': GoogleMaps
    },
    data() {
        return {
            msg: 'Contact',
            socials: {
                svg: {
                    instagram: ASSETS_PATH + '/social networks/instagram.svg',
                    facebook: ASSETS_PATH + '/social networks/facebook.svg',
                    googlePluse: ASSETS_PATH + '/social networks/google-plus.svg',
                    linkedin: ASSETS_PATH + '/social networks/linkedin.svg',
                    pinterest: ASSETS_PATH + '/social networks/pinterest.svg',
                    skype: ASSETS_PATH + '/social networks/skype.svg',
                    telegram: ASSETS_PATH + '/social networks/telegram.svg',
                    twitter: ASSETS_PATH + '/social networks/twitter.svg',
                    whatsapp: ASSETS_PATH + '/social networks/whatsapp.svg',
                    youtube: ASSETS_PATH + '/social networks/youtube.svg'
                },
                png: {
                    instagram: ASSETS_PATH + '/social networks/instagram.png',
                    facebook: ASSETS_PATH + '/social networks/facebook.png',
                    googlePluse: ASSETS_PATH + '/social networks/google-plus.png',
                    linkedin: ASSETS_PATH + '/social networks/linkedin.png',
                    pinterest: ASSETS_PATH + '/social networks/pinterest.png',
                    skype: ASSETS_PATH + '/social networks/skype.png',
                    telegram: ASSETS_PATH + '/social networks/telegram.png',
                    twitter: ASSETS_PATH + '/social networks/twitter.png',
                    whatsapp: ASSETS_PATH + '/social networks/whatsapp.png'
                }
            }
        };
    },
    created() {
        window.document.title = "تماس با ما";
    }
}
</script>

<style scoped>
    .videio-embed {display: block; padding-top: 57%;}
    .h_iframe-aparat_embed_frame{position:relative;} 
    .h_iframe-aparat_embed_frame .ratio {display:block;width:100%;height:auto;} 
    .h_iframe-aparat_embed_frame iframe {position:absolute;top:0;left:0;width:100%; height:100%;}
</style>
