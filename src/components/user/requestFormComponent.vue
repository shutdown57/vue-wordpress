<template>
    <div>
        <div v-if="alert_msg.msg" class="alert alert-danger text-center" role="alert">
            {{ alert_msg.msg }}
        </div>
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading" dir="rtl">
                        <h3 class="panel-title text-center">فرم درخواست سفارش</h3>
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
                                    <textarea v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('description')}"
                                            dir="rtl" type="text" id="description" class="form-control" name="description" placeholder="توضیحات"
                                            data-vv-delay="500" v-model="order.description"></textarea>
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('description')">{{ "لطفا زبان صفحه کلید خود را فارسی کنید." }}</div>
                                </div>
                            </div><!-- Description -->

                            <!-- Bussiness -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('bussiness')}"
                                            dir="rtl" type="text" id="bussiness" class="form-control" name="bussiness" placeholder="نام تجاری"
                                            data-vv-delay="500" v-model="order.name">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('bussiness')">{{ "نام تجاری باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Bussiness -->

                            <!-- Bussiness -->
                            <div class="col-xs-12">
                                <select class="form-control" v-model="order.product">
                                    <option disabled value="">لطفا یک مورد را انتخاب کنید</option>
                                    <option v-for="product in productTypes" :value="product.value">{{product.text}}</option>
                                </select>
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('bussiness')}"
                                            dir="rtl" type="text" id="bussiness" class="form-control" name="bussiness" placeholder="نام تجاری"
                                            data-vv-delay="500" v-model="order.name">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('bussiness')">{{ "نام تجاری باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Bussiness -->
                            <br>
                            <!-- Submit button -->
                            <!-- <vue-recaptcha sitekey="6Ld88UAUAAAAAA8jM-GSJcN0wHPpmZNqKUdTOP-V"> -->
                                <button type="button" @click="getData(order)" class="btn btn-success btn-block">ثبت نام</button>
                            <!-- </vue-recaptcha> -->
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
            //
        }
    },
    
    data() {
        return {
            order: {},
            alert_msg: {},
            validation: {...VALIDATIONS},
            productTypes: [
                {text: 'تقویم مگنتی', value: 'calendar'},
                {text: 'وایت برد مگنتی', value: 'white-board'},
                {text: 'مگنت مذهبی', value: 'religion'},
                {text: 'برنامه درسی مگنتی', value: 'curriculum'},
                {text: 'ماژیک مگنتی', value: 'marker'},
                {text: 'قاب عکس مگنتی', value: 'picture-frame'},
                {text: 'کارت اشتراک مگنتی', value: 'subscrib-card'},
                {text: 'کارت ویزیت مگنتی', value: 'visit-card'},

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
