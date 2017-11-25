<template>
    <h1>{{ msg }}</h1>
</template>

<script>
/**
 * @component: About
*/

export default {
    name: 'about',
    data() {
        return {
            msg: 'About'
        };
    },
    created() {
        window.document.title = "درباره ما";
    }
}
</script>

<style scoped>

</style>
