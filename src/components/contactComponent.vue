<template>
    <div>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">توضیحات</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">فرم تماس با ما</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">شبکه‌های اجتماعی</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" dir="rtl">
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
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="embed-responsive embed-responsive-16by9 h_iframe-aparat_embed_frame">
                    <span style="video-embed"></span><iframe class="embed-responsive-item" src="https://www.aparat.com/video/video/embed/videohash/MhCaN/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">...</div>
            <div role="tabpanel" class="tab-pane" id="settings">...</div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Contact
*/
import GoogleMaps from './layouts/googleMapsComponent.vue';

export default {
    name: 'contact',
    components: {
        'google-map': GoogleMaps
    },
    data() {
        return {
            msg: 'Contact'
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
