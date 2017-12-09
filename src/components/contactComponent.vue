<template>
    <div>
        <h1>{{ msg }}</h1>
        <hr>
        <google-map></google-map>
    </div>
</template>

<script>
/**
 * @component: Contact
*/
import GoogleMaps from './layouts/googleMapsComponent.vue';

export default {
    name: 'contact',
    components: {
        'google-map': GoogleMaps
    },
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
