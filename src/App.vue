<template>
  <div>
    <app-nav></app-nav>
    <div class="container">
      <router-view></router-view>
    </div>
    <app-footer></app-footer>
    <!-- {{site_info()}} -->
  </div>
</template>

<script>
/**
 * @component: App
 * Root component
*/
import navComponent from './components/layouts/navComponent.vue';
import footerComponent from './components/layouts/footerComponent.vue';

// import {store} from './store/index';
import {mapState, mapActions} from 'vuex';


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
      this.$http.get('http://wordpress.app/wp-json/' + 'wp/v2/posts')
        .then((resp) => {
          console.log(resp);
          // this.test = resp.
        }).catch((err) => {
          console.error(err);
        });
      // api.getPostsAll([1, 2, 3], 0).then((rej => {
      //   console.log(rej);
      // }, (res) => {
      //   console.log(res.body);
      // }));
      // console.log(api.getPostsAll(1, 0));
    }
  }
}
</script>

<style scoped>
</style>
