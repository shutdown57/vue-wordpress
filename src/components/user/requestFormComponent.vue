<template>
    <div>
        <div v-if="alert_msg.msg" class="alert text-center" :class="alert_msg.type" role="alert">
            {{ alert_msg.msg }}
        </div>
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading" dir="rtl">
                        <h3 class="panel-title text-center">فرم سفارش محصول</h3>
                    </div>
                    <div class="panel-body">
                        <form dir="rtl" action="#">

                            <!-- Title -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('title')}"
                                            dir="rtl" type="text" id="title" class="form-control" name="title" placeholder="موضوغ"
                                            data-vv-delay="500" v-model="order.title">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('title')">{{ "لطفا زبان صفحه کلید خود را فارسی کنید." }}</div>
                                </div>
                            </div><!-- Title -->

                            <!-- Description -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="description">پر کردن این قسمت اختیاری میباشد</label>
                                    <textarea v-validate="{regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('description')}"
                                            dir="rtl" type="text" id="description" class="form-control" name="description" placeholder="توضیحات"
                                            data-vv-delay="500" v-model="order.description"></textarea>
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('description')">{{ "لطفا زبان صفحه کلید خود را فارسی کنید." }}</div>
                                </div>
                            </div><!-- Description -->

                            <!-- Bussiness -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('bussiness')}"
                                            dir="rtl" type="text" id="bussiness" class="form-control" name="bussiness" placeholder="نام تجاری"
                                            data-vv-delay="500" v-model="order.name">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('bussiness')">{{ "نام تجاری باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Bussiness -->

                            <!-- Bussiness -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <select class="form-control" v-model="order.product">
                                        <option disabled value="">محصول مگنتی</option>
                                        <option v-for="product in productTypes" :value="product.value">{{product.text}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" v-model="order.circulation">
                                        <option disabled value="">تیراژ سفارش</option>
                                        <option v-for="circ in circulation" :value="circ">{{circ}}</option>
                                    </select>
                                </div>
                            </div><!-- Bussiness -->

                            <!-- X * Y -->
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="X">طول</label>
                                        <input class="form-control" type="text" name="X" id="X" v-model="order.X"
                                                 v-validate="{regex: validation.XY}" placeholder="طول"
                                                 :class="{'input': true, 'is-danger': errors.has('X')}">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="Y">عرض</label>
                                        <input class="form-control" type="text" name="Y" id="Y" v-model="order.Y"
                                                v-validate="{regex: validation.XY}" placeholder="عرض"
                                                :class="{'input': true, 'is-danger': errors.has('Y')}">
                                    </div>
                                </div>
                            </div> <!-- X * Y -->
                            <br>
                            <!-- Submit button -->
                            <button type="button" @click="sendRequest(order)" class="btn btn-success btn-block">ثبت نام</button>
                            <!-- Submit button -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * Request Form
 */
import {VALIDATIONS, NONCE} from '../../config';

export default {
    name: 'requestForm',

    methods: {
        sendRequest(order) {
            let user = this.$ls.get('info', false);
            if (!user) {
                return false;
            }
            order.user_email = user.__email;

            this.$http.get('http://wordpress.app/wp-json/forms/v1/order',
                {
                    params: {
                        title: order.title,
                        description: order.description,
                        name: order.name,
                        productType: order.product,
                        circulation: order.circulation,
                        size_X: order.X,
                        size_Y: order.Y,
                        user_email: user.__email
                    },
                    before: (request) => {
                        request.headers.set('X-WP-Nonce', NONCE);
                        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                        request.headers.set('Authorization', 'Basic ' + user.__token);
                    }
                }
                ).then((resp) => {
                    this.alert_msg.have = true;
                    this.alert_msg.msg = 'پیام با موفقیت ارسال شد';
                    this.alert_msg.type = 'alert-success';
                }, (err) => {
                    this.alert_msg.have = true;
                    this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                    this.alert_msg.type = 'alert-danger';
                 });
        }
    },

    created() {
        window.document.title = 'فرم سفارش مگنت';
    },

    data() {
        return {
            order: {},
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            },
            validation: {...VALIDATIONS},
            productTypes: [
                {text: 'تقویم مگنتی', value: 'تقویم مگنتی'},
                {text: 'وایت برد مگنتی', value: 'وایت برد مگنتی'},
                {text: 'مگنت مذهبی', value: 'مگنت مذهبی'},
                {text: 'برنامه درسی مگنتی', value: 'برنامه درسی مگنتی'},
                {text: 'ماژیک مگنتی', value: 'ماژیک'},
                {text: 'قاب عکس مگنتی', value: 'قاب عکس مگنتی'},
                {text: 'کارت اشتراک مگنتی', value: 'کارت اشتراک مگنتی'},
                {text: 'کارت ویزیت مگنتی', value: 'کارت ویزیت مگنتی'},

            ],
            circulation: [
                1000,
                2000,
                3000,
                4000,
                5000,
                6000,
                7000,
                8000,
                9000,
                10000,
            ]
        };
    }
}
</script>

<style>

</style>
