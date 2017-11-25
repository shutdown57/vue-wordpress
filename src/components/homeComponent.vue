<template>
    <h1>{{ msg }}</h1>
</template>

<script>
/**
 * @component: Home
*/
export default {
    name: 'home',
    data() {
        return {
            msg: 'Home'
        };
    },
    created() {
        window.document.title = "ایرانیان مگنت";
    }
}
</script>

<style scoped>

</style>
