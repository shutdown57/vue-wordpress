import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import * as VueGoogleMaps from 'vue2-google-maps';
import SocialSharing from 'vue-social-sharing';
import VeeValidate from 'vee-validate';
import VueLocalStorage from 'vue-ls';
import Carousel3d from 'vue-carousel-3d';

import App from './App.vue';
import Routes from './routes';
import {store} from './store/index';
import {GMAPS_OPT, veeConfig, LOCALSTORAGE_OPT} from './config';

Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueGoogleMaps, GMAPS_OPT);
Vue.use(SocialSharing);
Vue.use(VeeValidate, veeConfig);
Vue.use(VueLocalStorage, LOCALSTORAGE_OPT);
Vue.use(Carousel3d);

const router = new VueRouter({
  routes: Routes,
  mode: 'history'
});

router.beforeEach((to, from , next) => {
  if (!to.matched.length) {
    next('/404');
  }
  
  next();
});

router.afterEach((to, from) => {
  if (from.path === '/login' && Vue.ls.get('access_token', false) ) {
    router.push({name: 'home'});
    window.location.reload(true);
    console.log(from.path);
  }

  if (from.path === '/logout') {
    window.location.reload(true);
    console.log(from.paht);
  }
});

new Vue({
  store: store,
  el: '#app',
  render: h => h(App),
  router: router
});
