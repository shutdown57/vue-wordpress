<template>
    <div>
        <h1>Single Blog</h1>
        {{postDetails}}
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
            postDetails: ({postDetails}) => postDetails,
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
            const pid = this.$route.params.pid;
            this.getPostDetails(pid);
        }
    },

    created() {
        this.initParam();
    }
}
</script>

<style>

</style>
