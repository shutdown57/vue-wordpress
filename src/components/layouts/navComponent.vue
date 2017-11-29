<template>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header navbar-right" dir="rtl">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">ایرانیان مگنت</a> -->
      <router-link :to="{name: 'home'}" exact class="navbar-brand">ایرانیان مگنت</router-link>
    </div>

    <div class="collapse navbar-collapse" id="bs-navbar-collapse-menu">
      <ul class="nav navbar-nav navbar-right" dir="rtl">
        <li><router-link :to="{name: 'about'}" exact>درباره ما<span class="sr-only">(current)</span></router-link></li>
        <li><router-link :to="{name: 'contact'}" exact>تماس با ما<span class="sr-only">(current)</span></router-link></li>
        <li><router-link :to="{name: 'blog'}" exact>بلاگ<span class="sr-only">(current)</span></router-link></li>
        <!-- <li><router-link :to="{name: 'products'}" exact>محصولات<span class="sr-only">(current)</span></router-link></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" dir="rtl" aria-haspopup="true" aria-expanded="false">دسته بندی محصولات <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><router-link :to="{name: 'curriculum'}" exact class="text-right">برنامه درسی مگنتی<span class="sr-only">(current)</span></router-link></li>
            <li><a href="#" class="text-right">Another action</a></li>
            <li><a href="#" class="text-right">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><router-link :to="{name: 'products'}" exact class="text-right">تمامی محصولاث<span class="sr-only">(current)</span></router-link></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
      <!-- <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul> -->
    <!--</div>--><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</template>

<script>
/**
 * @component: Nav
*/
export default {
    name: 'nav'
}
</script>

<style scoped>

</style>
