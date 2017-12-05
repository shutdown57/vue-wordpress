<template>
    <div></div>
</template>

<script>
/**
 * @component: Product Single
 */
import api from '../../api';
import {PRODUCT_CATEGORIES_IN} from '../../store/staticsCategories';

export default {
    name: 'productSingle',
    
    watch: {
        '$route': 'initParam'
    },

    methods: {
        initParam() {
            const pid = this.$route.params.id;
            return pid;
        },
        removeArray(arr, el) {
            return arr.filter(e => e !== el);
        },
        addArray(el) {
            let arr = [];
            arr.push(el);
            return arr;
        }
    },
    
    data() {
        return {
            product: {}
        };
    },

    created() {
        let id = this.initParam();
        // Convert id to number and push it to an array
        id = this.addArray(parseInt(id));
        let allCategories = [...PRODUCT_CATEGORIES_IN, ...[1, 2, 17]];
        // Remove id from allCategories array
        allCategories = this.removeArray(allCategories, id);
        api.getPostsAll(id, allCategories)
            .then(res => {
                console.log(res);
            }, rej => { console.error(rej); });
    }
}
</script>

<style>

</style>
