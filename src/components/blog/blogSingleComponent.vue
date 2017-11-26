<template>
    <div>
        <h1>Single Blog</h1>
        {{print()}}
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
            pid: ({route}) => route.params.pid,
            postDetails: ({postDetails}) => postDetails
        })
    },

    watch: {
        '$route': 'initParam'
    },

    methods: {
        ...mapActions([
            'getPostDetails'
        ]),
        // initParam() {
        //     const pid = this.$route.params.pid;
        //     this.getPostDetails(pid);
        // },
        print() {
            console.log(this.postDetails);
        }
    },

    created() {
        // this.initParam();
        const pid = this.$route.params.pid;
        this.getPostDetails(pid);
    },

    updated() {
        window.document.title = this.postDetails.slug
    }
}
</script>

<style>

</style>
