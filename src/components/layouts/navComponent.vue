<template>
<nav class="navbar nav-bg navbar-static-top navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header navbar-right" dir="rtl">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <router-link :to="{name: 'home'}" exact class="navbar-brand">ایرانیان مگنت</router-link>
    </div>

    <div class="collapse navbar-collapse" id="bs-navbar-collapse-menu">
      <ul class="nav navbar-nav" dir="rtl">
        <li v-show="isUser"><router-link :to="{name: 'register'}" exact>ثبت نام<span class="sr-only">(current)</span></router-link></li>
        <li v-show="isUser"><router-link :to="{name: 'login'}" exact>ورود<span class="sr-only">(current)</span></router-link></li>
        <li v-show="!isUser"><router-link :to="{name: 'logout'}" exact><span class="glyphicon glyphicon-off"></span><span class="sr-only">(current)</span></router-link></li>
        <li v-show="!isUser"><router-link :to="{name: 'profile'}" exact>{{ user.__name }}<span class="sr-only">(current)</span></router-link></li>
        <li v-show="!isUser"><router-link :to="{name: 'requestForm'}" exact>ارسال درخواست<span class="sr-only">(current)</span></router-link></li>
        <li v-show="!isUser"><router-link :to="{name: 'sentForms'}" exact>لیست درخواست‌ها<span class="sr-only">(current)</span></router-link></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" dir="rtl">
        <li><router-link :to="{name: 'about'}" exact>درباره ما<span class="sr-only">(current)</span></router-link></li>
        <li><router-link :to="{name: 'contact'}" exact>تماس با ما<span class="sr-only">(current)</span></router-link></li>
        <li><router-link :to="{name: 'blog'}" exact>بلاگ<span class="sr-only">(current)</span></router-link></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" dir="rtl" aria-haspopup="true" aria-expanded="false">دسته بندی محصولات<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right dropdown-style">
            <li><router-link :to="{name: 'curriculum'}" exact class="text-right dropdown-menu-link">برنامه درسی مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'whiteBoard'}" exact class="text-right dropdown-menu-link">وایت برد مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'calendar'}" exact class="text-right dropdown-menu-link">تقویم مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'different'}" exact class="text-right dropdown-menu-link">انواع مختلف مگنت<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'marker'}" exact class="text-right dropdown-menu-link">ماژیک مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'onCar'}" exact class="text-right dropdown-menu-link">مگنت روی بدنه خودرو<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'pictureFrame'}" exact class="text-right dropdown-menu-link">قاب عکس مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'religion'}" exact class="text-right dropdown-menu-link">مگنت مذهبی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'subscribCard'}" exact class="text-right dropdown-menu-link">کارت اشتراک مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><router-link :to="{name: 'visitCard'}" exact class="text-right dropdown-menu-link">کارت ویزیت مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li role="separator" class="divider"></li>
            <li><router-link :to="{name: 'products'}" exact class="text-right dropdown-menu-link">تمامی محصولاث<span class="sr-only">(current)</span></router-link></li>
          </ul>
        </li>
      </ul>
    </div>
  </div><!-- /.container-fluid -->
</nav>
</template>

<script>
/**
 * @component: Nav
*/
import VueImageLoader from 'vue-img-loader';
import {ASSETS_PATH} from '../../config';
import User from '../../mixins/user';

export default {
    name: 'app-nav',

    data() {
      return {
        logo_small: ASSETS_PATH + '/favicon.png',
        user: {},
        token_: false
      };
    },

    computed: {
      isUser: function() {
        this.$forceUpdate();
        setInterval(() => {
          this.token_ = this.$ls.get('access_token', false);
        },)
        if (this.token_) {
          this.user = {...this.$ls.get('info', false)};
          return false;
        } else {
          return true;
        }
      }
    },

    components: {
      'image-loader': VueImageLoader
    }
}
</script>

<style scoped>
address {
  font-size: 1.5em;
}
.com-info {
  background-color: #2d4a4e;
  color:#0e0b16;
  padding-top: 1em;
  padding-bottom: 0px;
}

/* #2d4a4e -> medium-dark 
 * #1e3235 -> dark
 * #1c8a9b -> meduim
 * #00dsff -> low
*/

.nav-bg {
  background-color: #0e0b16 !important;
  color: #e7dfdd !important;
}

a {
  color: #e7dfdd !important;
}

a.dropdown-toggle:hover, a.dropdown-toggle:active, a.dropdown-toggle:focus {
  background-color: #000000 !important;
  color: #e7dfdd !important;
}
.dropdown-menu-link:hover, .dropdown-menu-link:focus, .dropdown-menu-link:active {
  background-color: #808080 !important;
  color: #e7dfdd !important;
}
a.router-link-exact-active.router-link-active {
  background-color: #696969 !important;
  color: #e7dfdd !important;
}

.nav > li > a:focus, .nav > li > a:hover {
  background-color: #808080 !important;
  color: #e7dfdd !important;
}

.dropdown-menu > li > a.text-right:focus, .dropdown-menu > li > a.text-right:hover {
  background-color: #696969 !important;
  color: #e7dfdd !important;
  background-image: none !important;
}

.dropdown-style {
  background-color: #808080 !important;
}
</style>
