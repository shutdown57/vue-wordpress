<template>
  <div class="bg-main fixed-bg">
    <app-nav></app-nav>
    <div class="push-to-bottom container">
      <router-view id="main-content"></router-view>
    </div>
    <app-footer></app-footer>
  </div>
</template>

<script>
/**
 * @component: App
 * Root component
*/
import navComponent from './components/layouts/navComponent.vue';
import footerComponent from './components/layouts/footerComponent.vue';

export default {
  name: 'app',

  components: {
    'app-nav': navComponent,
    'app-footer': footerComponent
  }
}
</script>

<style>
@font-face {
  font-family: Khodkar-Bold;
  src: url("http://wordpress.app/wp-content/themes/vue-new/src/assets/fonts/Khodkar-Bold.ttf");
}
.bg-main {
  background-color: #e7dfdd;
}

.fixed-bg {
  background-image: url("http://wordpress.app/wp-content/themes/vue-new/src/assets/background.ai.svg");
  min-height: 500px;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover; 
}

body {
  padding-top: 50px;
  font-family: 'Khodkar-Bold';
  font-size: 200%;
}
.push-to-bottom { min-height: calc(100vh); }
</style>
