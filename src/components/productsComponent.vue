<template>
    <div class="direction-rtl">
        <h1>{{msg}}</h1>
    </div>
</template>

<script>
/**
 * @component: Products
*/
import {mapState, mapActions} from 'vuex'

export default {
    name: 'products',
    
    data() {
        return {
            
            msg: 'محصولات'
        };
    },

    computed: {
        ...mapState({
            productList: ({productList}) => productList.items
        })
    },

    created() {
        window.document.title = 'محصولات';
        this.getProductList();
        // if ( this.productList.length < 1) {
        //     this.getProductList();
        // }
    },

    methods: {
        ...mapActions([
            'getProductList'
        ])
    }
}
</script>

<style>
.direction-rtl { direction: rtl; }
</style>
