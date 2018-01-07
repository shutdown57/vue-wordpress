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
      this.$http.get('http://wordpress.app/wp-json/hook/v1/message')
        .then((resp) => {
          console.log(resp);
        }).catch((err) => {
          // console.error(err);
        });

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

      // Login user
      // this.$http.get('http://wordpress.app/wp-json', { }, {
      //   method: 'GET',
      //   params: { username: 'sam', password: '1234' },
      //   before: (request) => {
      //     request.headers.set('X-WP-Nonce', NONCE);
      //     request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
      //     request.headers.set('Authorization', 'Basic ' + Base64.encode('sam:1234'));
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

      // JWT
      // Do stuff (Create post ...)
      // this.$http.post('http://wordpress.app/wp-json/jwt-auth/v1/token', {}, {
      //   before: (request) => {
      //     request.headers.set('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93b3JkcHJlc3MuYXBwIiwiaWF0IjoxNTE0MDM1MDQyLCJuYmYiOjE1MTQwMzUwNDIsImV4cCI6MTUxNDYzOTg0MiwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoiMSJ9fX0.v__jZnjZWxjytmD0-UBcBXDHNj_JOxhR3rK_i1ctzL0')
      //   }
      // })
      //   .then((resp) => {
      //     console.log(resp.body.token);
      //   }).catch((err) => {
      //     console.error(err);
      //   });

      // Login
      // this.$http.get('http://wordpress.app/wp-json/jwt-auth/v1/', {
      //   username: 'sam',
      //   password: '1234'
      // })
      //   .then((resp) => {
      //     console.log(resp);
      //   }).catch((err) => {
      //     console.error(err);
      //   });

      // Create user
      // this.$http.post('http://wordpress.app/wp-json/wp/v2/users', { }, {
      //   method: 'POST',
      //   params: { username: 'test2', password: '1234', email: 'test2@test.com' },
      //   before: (request) => {
      //     request.headers.set('X-WP-Nonce', NONCE);
      //     request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
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
