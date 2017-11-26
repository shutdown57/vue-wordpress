<template>
    <router-view></router-view>
</template>

<script>
/**
 * @component: Blog
*/
import blogSingle from './blog/blogSingleComponent.vue';
import blogAll from './blog/blogAllComponent.vue';

export default {
    name: 'blog',
    components:{
        'blog-all': blogAll,
        'blog-single': blogSingle
    },
    data() {
        return {
            msg: 'اخبار ایرانیان مگنت'
        };
    }
}
</script>

<style scoped>
</style>
