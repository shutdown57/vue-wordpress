<template>
  <footer dir="rtl" class="navbar-default">
      <div class="container-fluid">
        <span>{{msg}}</span>
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
    background-color: #cccccc;
    /* position: fixed; */
    left: 0;
    bottom: 0;
    width: 100%;
}
.blacky {
  background-color: #000000;
  color: #cccccc;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}
</style>
