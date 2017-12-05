<template>
    <div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <image-loader :src="path"
                              width="600"
                              height="800"
                              class="img-responsive img-rounded"
                              :preview="ASSETS_PATH + '/logo.png'"></image-loader>
                <!-- <img :src="path" alt=""> -->
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Home
*/
import VueImageLoader from 'vue-img-loader';
import {ASSETS_PATH} from '../config';

export default {
    name: 'home',

    components: {
        'image-loader': VueImageLoader
    },

    data() {
        return {
            path: ASSETS_PATH + '/logo.png',
            msg: 'Home'
        };
    },

    methods: {
        loadImage(path) {
            return require(path);
        }
    },

    created() {
        window.document.title = "ایرانیان مگنت";
    }
}
</script>

<style scoped>
img { width: 100% !important; height: 100%; }
</style>
