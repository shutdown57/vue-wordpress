<template>
    <h1>{{ msg }}</h1>
</template>

<script>
/**
 * @component: Contact
*/
export default {
    name: 'contact',
    data() {
        return {
            msg: 'Contact'
        };
    },
    created() {
        window.document.title = "تماس با ما";
    }
}
</script>

<style scoped>

</style>
