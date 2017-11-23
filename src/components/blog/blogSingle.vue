<template>
    <div>
        <h1>Single Blog</h1>
        <p>{{postDetail}}</p>
    </div>
</template>

<script>
/**
 * @component: SingleBlog
*/
import {mapActions, mapState} from 'vuex';

export default {
    name: 'blogSingle',

    computed: {
        ...mapState({
            postDetail: ({postDetail}) => postDetail.item,
            pid: ({route}) => route.params.id
        })
    },
    
    watch: {
        '$route': 'initParam'
    },
    
    methods: {
        ...mapActions([
            'getPostDetails'
        ]),
        initParam() {
            const pid = this.$route.params.id;
            this.getPostDetails(pid);
        }
    },
    
    created() {
        this.initParam();
        console.log('yay!');
    }
}
</script>

<style>

</style>
