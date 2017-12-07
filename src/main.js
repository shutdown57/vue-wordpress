import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import * as VueGoogleMaps from 'vue2-google-maps';

import App from './App.vue';
import Routes from './routes';
import {store} from './store/index';
import {GMAPS_OPT} from './config';

Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(VueGoogleMaps, GMAPS_OPT);

const router = new VueRouter({
  routes: Routes,
  mode: 'history'
});

router.beforeEach((to, from , next) => {
    if (!to.matched.length) {
        next('/404');
    } else {
        next();
    }
});

new Vue({
  store: store,
  el: '#app',
  render: h => h(App),
  router: router
});
