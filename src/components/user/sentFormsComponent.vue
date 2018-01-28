<template>
    <div>
        <table class="table table-bordered table-hover table-striped table-xs-block">
            <tr class="head-bg">
                <th>#</th>
                <th>نام</th>
                <th>عنوان</th>
                <th>توضیحات</th>
                <th>نوع سفارش</th>
                <th>تیراژ</th>
                <th>اندازه</th>
                <th>تاریخ سفارش</th>
            </tr>
            <tr v-for="(order, index) in orders">
                <td>{{index}}</td>
                <td>{{order.name}}</td>
                <td>{{order.title}}</td>
                <td>{{order.description}}</td>
                <td>{{order.product_type}}</td>
                <td>{{order.circulation}}</td>
                <td>{{order.size}}</td>
                <td>{{order.date}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
/**
 * Sent Forms
 */
import {NONCE} from '../../config';

export default {
    name: 'sentForms',

    data() {
        return {
            user: {},
            orders: []
        };
    },

    methods: {
        getData() {
            this.user = this.$ls.get('info');
            // console.log(user.__token);
            // console.log(NONCE);
            this.$http.get('http://wordpress.app/wp-json/forms/v1/orders', {
                params: {
                    user_email: this.user.__email
                },
                before: (request) => {
                    request.headers.set('X-WP-Nonce', NONCE);
                    request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    request.headers.set('Authorization', 'Basic ' + this.user.__token);
                }
            }).then((resp) => {
                console.log(resp);
                this.orders = [...resp.body.data.orders];
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
.head-bg { background-color: aliceblue; }
</style>
