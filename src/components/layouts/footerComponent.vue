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
            <h2>Social network</h2>
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
  background-color: #a239ca !important;
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
  background-color: #4717f6;
  color: #e7dfdd;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}
</style>
