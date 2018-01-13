<template>
  <footer dir="rtl" class="navbar-default">
      <div v-if="homePath">
        <div class="row thumbnail-bg">
          <div class="col-xs-12">
            <h4 class="text-center">برخی از مشتریان ما</h4>
            <carousel-3d :autoplay="true" :autoplay-timeout="3000" :display="5" :width="300" :height="200">
              <slide class="slides" v-for="(brand, index) in brands" :index="index">
                  <img :src="brand">
              </slide>
            </carousel-3d>
          </div>
        </div>
      </div>
      <div class="container-fluid footer-top">
        <br>
        <div class="row">
          <div class="col-sm-12 col-md-4 text-center">
            <h2>Last post and archive</h2>
            <div>
              <span>
                <router-link class="btn btn-link" :to="{name: 'tags'}" exact>برچسب‌ها</router-link>
              </span>
              <span>
                <router-link class="btn btn-link" :to="{name: 'categories'}" exact>دسته‌بندی‌ها</router-link>
              </span>
            </div>
          </div>
          <div class="col-sm-12 col-md-4 text-center">
            <h3>به اشتراک گذاری این صفحه</h3>
            <social-sharing
                title="مگنت ایرانیان"
                description="تولید کننده انواع مگنت در سایزها و قالبهای مختلف"
                quote="ایرانیان مگنت اولین و بزرگترین تولید کننده مگنت در ایران"
                hashtags="مگنت, مگنت تبلیغاتی, ایراینان مگنت, آهیربای رویخچالی, کارت ویزیت, وایت بورد"
                twitter-user="iranianmagent"
                inline-template>
              <div class="text-center">
                <div class="row">
                  <div class="col-xs-2 col-xs-offset-3">
                    <network network="telegram">
                      <img class="img-responsive img-icon" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/telegram-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="twitter">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/twitter-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="reddit">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/reddit-50.png'">
                    </network>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 col-xs-offset-3">
                    <network network="facebook">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/facebook-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="googleplus">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/google-plus-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="linkedin">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/linkedin-50.png'">
                    </network>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-2 col-xs-offset-3">
                    <network network="pinterest">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/pinterest-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="email">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/email-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="skype">
                      <img class="img-responsive" :src="'http://wordpress.app' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/skype-50.png'">
                    </network>
                  </div>
                </div>
              </div>
            </social-sharing>
          </div>
          <div class="col-sm-12 col-md-4 text-center">
            <h2>Enamad</h2>
          </div>
        </div>
        <br>
      </div>
      <div class="blacky">
        <p dir="rtl">تمام حقوق متعلق به شرکت ایرانیان مگنت مباشد.</p>
      </div>
  </footer>
</template>

<script>
/**
 * @component: Footer
*/
import VueImageLoader from 'vue-img-loader';
import {ASSETS_PATH} from '../../config';

export default {
  name: 'app-footer',

  components: {
    'image-loader': VueImageLoader
  },

  computed: {
    homePath() {
      return this.$route.path === '/';
    }
  },

  data () {
    return {
      msg: "Footer",

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
    }
  }
}
</script>

<style scoped>
.img-icon {
  max-width: 20px;
  min-width: 16px;
  max-height: 20px;
  min-height: 16px;
  width: 16px;
  height: 16px;
}
footer {
    /* position: absolute !important; */
    left: 0;
    color: #e7dfdd;
    bottom: 0;
    width: 100%;
}
.btn-link{
  /* background-color: #a239ca !important; */
  background-color: #1c8a9b !important;
  color: #e7dfdd !important;
}
.btn-link > a.router-link-active,
.btn-link > a.router-link-active:hover,
.btn-link > a.router-link-active:focus {
  text-decoration: none;
  color: #e7dfdd;
}
.footer-top {
  background-color: #0e0b16 !important;
}
.blacky {
  /* background-color: #4717f6; */
  background-color: #1e3235;
  color: #e7dfdd;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}
.thumbnail-bg { background-color: black; color: azure; }
</style>
