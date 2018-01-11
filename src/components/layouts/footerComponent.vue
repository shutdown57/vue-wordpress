<template>
  <footer dir="rtl" class="navbar-default">
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
  name: 'footer',

  components: {
    'image-loader': VueImageLoader
  },

  data () {
    return {
      msg: "Footer",
      
      shareIcons: {
        telegram: {
          path: ASSETS_PATH + '/share-icons/telegram-50.png',
          name: 'telegram'
        },
        twitter: {
          path: ASSETS_PATH + '/share-icons/twitter-50.png',
          name: 'twitter'
        },
        email: {
          path: ASSETS_PATH + '/share-icons/email-50.png',
          name: 'email'
        },
        facebook: {
          path: ASSETS_PATH + '/share-icons/facebook-50.png',
          name: 'facebook'
        },
        googleplus: {
          path: ASSETS_PATH + '/share-icons/google-plus-50.png',
          name: 'googleplus'
        },
        linkedin: {
          path: ASSETS_PATH + '/share-icons/linkedin-50.png',
          name: 'linkedin'
        },
        pinterest: {
          path: ASSETS_PATH + '/share-icons/pinterest-50.png',
          name: 'pinterest'
        },
        reddit: {
          path: ASSETS_PATH + '/share-icons/reddit-50.png',
          name: 'reddit'
        },
        skype: {
          path: ASSETS_PATH + '/share-icons/skype-50.png',
          name: 'skype'
        }
      }
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
</style>
