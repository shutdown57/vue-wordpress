<template>
    <div>
        <div class="container">
  
        <h1>Bootstrap 3 Carousel Multiple Items Increment by 1</h1>

        <div class="row">
        <div class="col-md-12">
            <div class="carousel carousel-showmanymoveone slide" id="carousel-tilenav"
                    ref="itemToClone" data-interval="false">
                <div class="carousel-inner">
                    <div class="item active">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/0054A6/fff/&text=1" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/002d5a/fff/&text=2" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/d6d6d6/333&text=3" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/002040/eeeeee&text=4" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/0054A6/fff/&text=5" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/002d5a/fff/&text=6" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/eeeeee&text=7" class="img-responsive"></a>
                    </div>
                    </div>
                    <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="#"><img src="http://placehold.it/500/40a1ff/002040&text=8" class="img-responsive"></a>
                    </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-tilenav" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#carousel-tilenav" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
            </div>
        </div>
        </div>

        
        </div>
    </div>
</template>

<script>
// (function(){
//   $('.carousel-showmanymoveone .item').each(function(){
//     var itemToClone = $(this);

//     for (var i=1;i<6;i++) {
//       itemToClone = itemToClone.next();

//       // wrap around if at end of item collection
//       if (!itemToClone.length) {
//         itemToClone = $(this).siblings(':first');
//       }

//       // grab item, clone, add marker class, add to collection
//       itemToClone.children(':first-child').clone()
//         .addClass("cloneditem-"+(i))
//         .appendTo($(this));
//     }
//   });
// }());
export default {
    name: 'multi-slider',

    data() {
        return {
            itemToClone: ''
        };
    },

    mounted() {
        
    }
}
</script>

<style scoped>
.carousel-showmanymoveone .carousel-control {
   width: 4%;
   background-image: none;
}

.carousel-showmanymoveone .carousel-control.left {
   margin-left: 0;
}

.carousel-showmanymoveone .carousel-control.right {
   margin-right: 0;
}

.carousel-showmanymoveone .cloneditem-1,
.carousel-showmanymoveone .cloneditem-2,
.carousel-showmanymoveone .cloneditem-3 {
   display: none;
}

.carousel .item .col-xs-12 {
   padding: 0;
}


/* Medium Devices, Desktops */

@media only screen and (max-width: 992px) {
   .carousel .item .col-xs-12:nth-last-child(-n+2) {
      display: none;
   }
}

@media all and (min-width: 768px) {
   .carousel-showmanymoveone .carousel-inner > .active.left,
   .carousel-showmanymoveone .carousel-inner > .prev {
      left: -50%;
   }
   .carousel-showmanymoveone .carousel-inner > .active.right,
   .carousel-showmanymoveone .carousel-inner > .next {
      left: 50%;
   }
   .carousel-showmanymoveone .carousel-inner > .left,
   .carousel-showmanymoveone .carousel-inner > .prev.right,
   .carousel-showmanymoveone .carousel-inner > .active {
      left: 0;
   }
   .carousel-showmanymoveone .carousel-inner .cloneditem-1 {
      display: block;
   }
}

@media all and (min-width: 768px) and (transform-3d),
all and (min-width: 768px) and (-webkit-transform-3d) {
   .carousel-showmanymoveone .carousel-inner > .item.active.right,
   .carousel-showmanymoveone .carousel-inner > .item.next {
      -webkit-transform: translate3d(50%, 0, 0);
      transform: translate3d(50%, 0, 0);
      left: 0;
   }
   .carousel-showmanymoveone .carousel-inner > .item.active.left,
   .carousel-showmanymoveone .carousel-inner > .item.prev {
      -webkit-transform: translate3d(-50%, 0, 0);
      transform: translate3d(-50%, 0, 0);
      left: 0;
   }
   .carousel-showmanymoveone .carousel-inner > .item.left,
   .carousel-showmanymoveone .carousel-inner > .item.prev.right,
   .carousel-showmanymoveone .carousel-inner > .item.active {
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
      left: 0;
   }
}

@media all and (min-width: 992px) {
   .carousel-showmanymoveone .carousel-inner > .active.left,
   .carousel-showmanymoveone .carousel-inner > .prev {
      left: -16.6%;
   }
   .carousel-showmanymoveone .carousel-inner > .active.right,
   .carousel-showmanymoveone .carousel-inner > .next {
      left: 16.6%;
   }
   .carousel-showmanymoveone .carousel-inner > .left,
   .carousel-showmanymoveone .carousel-inner > .prev.right,
   .carousel-showmanymoveone .carousel-inner > .active {
      left: 0;
   }
   .carousel-showmanymoveone .carousel-inner .cloneditem-2,
   .carousel-showmanymoveone .carousel-inner .cloneditem-3 {
      display: block;
   }
}

@media all and (min-width: 992px) and (transform-3d),
all and (min-width: 992px) and (-webkit-transform-3d) {
   .carousel-showmanymoveone .carousel-inner > .item.active.right,
   .carousel-showmanymoveone .carousel-inner > .item.next {
      -webkit-transform: translate3d(16.6%, 0, 0);
      transform: translate3d(16.6%, 0, 0);
      left: 0;
   }
   .carousel-showmanymoveone .carousel-inner > .item.active.left,
   .carousel-showmanymoveone .carousel-inner > .item.prev {
      -webkit-transform: translate3d(-16.6%, 0, 0);
      transform: translate3d(-16.6%, 0, 0);
      left: 0;
   }
   .carousel-showmanymoveone .carousel-inner > .item.left,
   .carousel-showmanymoveone .carousel-inner > .item.prev.right,
   .carousel-showmanymoveone .carousel-inner > .item.active {
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
      left: 0;
   }
}
</style>
