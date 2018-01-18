<template>
    <div>
        <br><br>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">توضیحات</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">تصاویر</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">شبکه‌های اجتماعی</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">فرم درخواست</a></li>
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
                <hr>
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
                    <div class="col-sm-3 col-md-1 col-xs-offset-2">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.instagram" :onerror="socials.png.instagram">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.facebook" :onerror="socials.png.facebook">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.googlePluse" :onerror="socials.png.googlePluse">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.linkedin" :onerror="socials.png.linkedin">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.pinterest" :onerror="socials.png.pinterest">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.telegram" :onerror="socials.png.telegram">
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-1">
                        <a href="#" target="_blank">
                            <img :src="socials.svg.twitter" :onerror="socials.png.twitter">
                        </a>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <div>
                    <div v-if="alert_msg" class="alert alert-danger text-center" role="alert">
                        {{ alert_msg }}
                    </div>
                    <div class="row centered-form">
                        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading" dir="rtl">
                                    <h3 class="panel-title text-center">فرم درخواست</h3>
                                </div>
                                <div class="panel-body">
                                    <form dir="rtl" action="#">
                                        <!-- Email -->
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <input v-validate="{required: true, regex: validation.EMAIL}" :class="{'input': true, 'is-danger': errors.has('email')}"
                                                        dir="ltr" type="email" id="email" class="form-control" name="email" placeholder="ایمیل"
                                                        data-vv-delay="500" v-model="askForm.email">
                                                <br>
                                                <div v-show="errors.has('email')" class="alert alert-danger" role="alert">{{ "لطفا آدرس ایمیل خود را به درستی وارد کنید" }}</div>
                                            </div>
                                        </div><!-- Email -->
                                        <!-- Title -->
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('title')}"
                                                        dir="rtl" type="text" id="title" class="form-control" name="title" placeholder="موضوع"
                                                        data-vv-delay="500" v-model="askForm.title">
                                                <br>
                                                <div v-show="errors.has('title')" class="alert alert-danger" role="alert">{{ "موضوع باید به زبان فارسی باشد." }}</div>
                                            </div>
                                        </div><!-- Title -->
                                        <!-- Mobile -->
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <input v-validate="{required: true, regex: validation.MOBILE}" :class="{'input': true, 'is-danger': errors.has('mobile')}"
                                                        dir="rtl" type="text" id="mobile" class="form-control" name="mobile" placeholder="شماره موبایل"
                                                        data-vv-delay="500" v-model="askForm.mobile">
                                                <br>
                                                <div v-show="errors.has('mobile')" class="alert alert-danger" role="alert">{{ "شماره موبایل باید به زبان انگلیسی باشد." }}</div>
                                            </div>
                                        </div><!-- Mobile -->
                                        <!-- Content -->
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <textarea cols="30" rows="5" v-validate="{required: true, regex: validation.NAME}"
                                                        :class="{'input': true, 'is-danger': errors.has('content')}"
                                                        dir="rtl" type="text" id="content" class="form-control" name="content" placeholder="پرسش"
                                                        data-vv-delay="500" v-model="askForm.content"></textarea>
                                                <br>
                                                <div v-show="errors.has('content')" class="alert alert-danger" role="alert">{{ "متن باید به زبان فارسی باشد." }}</div>
                                            </div>
                                        </div><!-- Content -->
                                        <br>
                                        <!-- Submit button -->
                                        <button type="button" @click="getData(askForm)" class="btn btn-success btn-block">ارسال</button>
                                        <!-- Submit button -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Contact
*/
import GoogleMaps from './layouts/googleMapsComponent.vue';
import {
    ASSETS_PATH,
    VALIDATIONS,
    NONCE
} from '../config';
import {Base64} from '../mixins/utils';

export default {
    name: 'contact',
    
    components: {
        'google-map': GoogleMaps
    },

    data() {
        return {
            msg: '',
            validation: {...VALIDATIONS},
            askForm: {
                mobile: '',
                email: '',
                title: '',
                content: ''
            },
            socials: {
                svg: {
                    instagram: ASSETS_PATH + '/social networks/instagram.svg',
                    facebook: ASSETS_PATH + '/social networks/facebook.svg',
                    googlePluse: ASSETS_PATH + '/social networks/google-plus.svg',
                    linkedin: ASSETS_PATH + '/social networks/linkedin.svg',
                    pinterest: ASSETS_PATH + '/social networks/pinterest.svg',
                    telegram: ASSETS_PATH + '/social networks/telegram.svg',
                    twitter: ASSETS_PATH + '/social networks/twitter.svg'
                },
                png: {
                    instagram: ASSETS_PATH + '/social networks/instagram.png',
                    facebook: ASSETS_PATH + '/social networks/facebook.png',
                    googlePluse: ASSETS_PATH + '/social networks/google-plus.png',
                    linkedin: ASSETS_PATH + '/social networks/linkedin.png',
                    pinterest: ASSETS_PATH + '/social networks/pinterest.png',
                    telegram: ASSETS_PATH + '/social networks/telegram.png',
                    twitter: ASSETS_PATH + '/social networks/twitter.png'
                },
                path: {
                    pinterest: 'https://www.pinterest.com/iranianmagnet/',
                    facebook: 'https://www.facebook.com/iranianmagnet',
                    twitter: 'https://twitter.com/iranianmagnet',
                    telegram: 'https://t.me/iranianmagnet96',
                    linkedin: 'https://ir.linkedin.com/in/iranianmagnet',
                    googlePluse: 'https://plus.google.com/collection/EzoQWE',
                    instagram: 'https://www.instagram.com/iranian_magnet/'
                }
            }
        };
    },

    created() {
        window.document.title = "تماس با ما";
    },

    methods: {
        getData(form) {
            // Send email to iranian.group@yahoo.com
            this.$http.get('http://wordpress.app/wp-json/forms/v1/ask-question',
                {
                    params: {
                        email: form.email,
                        title: form.title,
                        content: form.content
                    },
                    before: (request) => {
                        request.headers.set('X-WP-Nonce', NONCE);
                        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    }
                }
            ).then((resp) => {
                // console.log(resp.body);
            }).catch((err) => {
                // console.log(err);
            });

            // Send message to IranianMagnetMessage
            this.$http.get('http://wordpress.app/wp-json/hook/v1/message',
                {
                    params: {
                        email: form.email,
                        title: form.title,
                        mobile: form.mobile,
                        content: form.content
                    },
                    before: (request) => {
                        request.headers.set('X-WP-Nonce', NONCE);
                        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    }
                }
            ).then((resp) => {
                // console.log(resp.body);
            }).catch((err) => {
                // console.log(err);
            });
        }
    }
}
</script>

<style scoped>
    .videio-embed {display: block; padding-top: 57%;}
    .h_iframe-aparat_embed_frame{position:relative;} 
    .h_iframe-aparat_embed_frame .ratio {display:block;width:100%;height:auto;} 
    .h_iframe-aparat_embed_frame iframe {position:absolute;top:0;left:0;width:100%; height:100%;}
</style>
