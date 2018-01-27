<template>
    <div>Sent Forms</div>
</template>

<script>
/**
 * Sent Forms
 */
import {NONCE} from '../../config';

export default {
    name: 'sentForms',

    methods: {
        getData() {
            let user = this.$ls.get('info');
            console.log(user.__token);
            console.log(NONCE);
            this.$http.get('http://wordpress.app/wp-json/forms/v1/orders', {
                params: {
                    user_email: user.__email
                },
                before: (request) => {
                    request.headers.set('X-WP-Nonce', NONCE);
                    request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    request.headers.set('Authorization', 'Basic ' + user.__token);
                }
            }).then((resp) => {
                console.log(resp);
            }, (err) => { /*console.error(err);*/ });
        }
    },

    created() {
        window.document.title = 'لیست فرم‌های ارسال شده';
        this.getData();
    }
}
</script>

<style scoped>

</style>
