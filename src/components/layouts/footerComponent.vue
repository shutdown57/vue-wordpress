<template>
  <footer dir="rtl" class="navbar-default">
      <div class="container-fluid footer-top">
        <br>
        <div class="row">
          <div class="col-sm-12 col-md-4 text-center">
            <div class="row">
              <div class="col-sm-12">
                <h2>برچسب‌ها و آرشیو مطالب</h2>
              </div>
              <div class="col-sm-12">
                <br>
                <span>
                  <router-link class="btn btn-link" :to="{name: 'tags'}" exact>برچسب‌ها</router-link>
                </span>
                <span>
                  <router-link class="btn btn-link" :to="{name: 'categories'}" exact>دسته‌بندی‌ها</router-link>
                </span>
              </div>
              <div class="col-sm-12" dir="ltr">
                <br>
                <img class="copyright img-responsive" :src="copyright.src" :alt="copyright.alt">
              </div>
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
                      <img class="img-responsive img-icon" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/telegram-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="twitter">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/twitter-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="reddit">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/reddit-50.png'">
                    </network>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xs-2 col-xs-offset-3">
                    <network network="facebook">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/facebook-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="googleplus">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/google-plus-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="linkedin">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/linkedin-50.png'">
                    </network>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-2 col-xs-offset-3">
                    <network network="pinterest">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/pinterest-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="email">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/email-50.png'">
                    </network>
                  </div>
                  <div class="col-xs-2">
                    <network network="skype">
                      <img class="img-responsive" :src="'https://www.iranianmagnet.com' + '/wp-content/themes/vue-new/src/assets' + '/share-icons/skype-50.png'">
                    </network>
                  </div>
                </div>
              </div>
            </social-sharing>
          </div>
          <div class="col-sm-12 col-md-4 text-center">
            <h3>تلفن‌های تماس</h3>
            <div class="row">
              <div class="col-xs-12">
                <h2>۰۲۱-۷۴۸۴۵</h2>
                <h3>۰۲۱-۷۷۶۸۱۴۰۰</h3>
                <h3>۰۲۱-۷۷۶۸۱۴۰۱</h3>
              </div>
            </div>
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

  data () {
    return {
      msg: "Footer",
      copyright: {
        src: ASSETS_PATH + '/copyright.png',
        alt: 'تمامی مطالب محفوظ است.'
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
.copyright {
  max-width: 50px;
  min-width: 50px;
  max-height: 50px;
  min-height: 50px;
  width: 50px;
  height: 50px;
}
div > img.copyright {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
footer {
    left: 0;
    color: #e7dfdd;
    bottom: 0;
    width: 100%;
}
.btn-link{
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
  background-color: #e0cf55;
  color: black;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}
</style>
