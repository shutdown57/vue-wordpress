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
            <h2>شبکه‌های اجتماعی</h2>
            <social-sharing
                title="مگنت ایرانیان"
                description="تولید کننده انواع مگنت در سایزها و قالبهای مختلف"
                quote="ایرانیان مگنت اولین و بزرگترین تولید کننده مگنت در ایران"
                hashtags="مگنت, مگنت تبلیغاتی, ایراینان مگنت, آهیربای رویخچالی, کارت ویزیت, وایت بورد"
                twitter-user="iranianmagent"
                inline-template>
              <div>
                <network network="email">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="facebook">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="googleplus">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="linkedin">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="pinterest">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="reddit">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="skype">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="telegram">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
                <network network="twitter">
                  <span class="glyphicon glyphicon-envelope"></span>
                </network>
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

export default {
  name: 'footer',
  data () {
    return {
        msg: "Footer"
    }
  }
}
</script>

<style scoped>
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
