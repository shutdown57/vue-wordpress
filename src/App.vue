<template>
  <div class="bg-main">
    <app-nav></app-nav>
    <div class="container">
      <router-view id="main-content"></router-view>
    </div>
    <app-footer></app-footer>
    {{site_info()}}
  </div>
</template>

<script>
/**
 * @component: App
 * Root component
*/
import navComponent from './components/layouts/navComponent.vue';
import footerComponent from './components/layouts/footerComponent.vue';
import {Base64} from './mixins/utils';

// import {store} from './store/index';
import {mapState, mapActions} from 'vuex';
import {NONCE} from './config';

export default {
  // store,
  name: 'app',

  components: {
    'app-nav': navComponent,
    'app-footer': footerComponent
  },

  methods: {
    // ...mapActions([
    //   'getPostsBlog'
    // ]),
    // To use endpoints => wp/v2/posts?categories=1&id=1
    site_info() {
      // console.log();
      // this.$http.get('http://wordpress.app/?rest_route=/')
      //   .then((resp) => {
      //     console.log(resp);
      //   }).catch((err) => {
      //     console.error(err);
      //   });

      // Edit user
      // this.$http.patch('http://wordpress.app/wp-json/wp/v2/users/me', { }, {
      //   method: 'PATCH',
      //   params: { description: 'test 3' },
      //   before: (request) => {
      //     request.headers.set('X-WP-Nonce', NONCE);
      //     request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
      //     request.headers.set('Authorization', 'Basic' + Base64.encode('sam:1234'));
      //     console.log(request);
      //   }
      // }).then(res => {
      //   console.log(res);
      // }, rej => { console.error(rej); });

      // Create user
      // this.$http.post('http://wordpress.app/wp-json/wp/v2/users', { }, {
      //   method: 'POST',
      //   params: { username: 'test', password: '1234', email: 'test@test.com' },
      //   before: (request) => {
      //     request.headers.set('X-WP-Nonce', NONCE);
      //     request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
      //     // request.headers.set('Authorization', 'Basic' + Base64.encode('sam:1234'));
      //     console.log(request);
      //   }
      // }).then(res => {
      //   console.log(res);
      // }, rej => { console.error(rej); });
    }
  }
}
</script>

<style>
.bg-main {
  background-color: #e7dfdd;
}
body { padding-top: 50px; }
</style>
