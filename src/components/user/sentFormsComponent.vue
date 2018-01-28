<template>
    <div>
        <div v-if="alert_msg.have" class="alert text-center" :class="alert_msg.type" role="alert">
            {{ alert_msg.msg }}
        </div>
        <br>
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
                <td>{{index + 1}}</td>
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
            orders: [],
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            }
        };
    },

    methods: {
        getData() {
            this.user = this.$ls.get('info');
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
                this.orders = [...resp.body.data.orders];
            }, (err) => { 
                this.alert_msg.have = true;
                this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                this.alert_msg.type = 'alert-danger';
             });
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
