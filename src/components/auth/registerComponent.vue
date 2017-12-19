<template>
    <div>
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading" dir="rtl">
                        <h3 class="panel-title">فرم ثبت نام<small> ثبت نام رایگان میباشد</small></h3>
                    </div>
                    <div class="panel-body">
                        <form dir="rtl">
                            <!-- First Name -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('first_name')}"
                                            dir="rtl" type="text" id="first_name" class="form-controller" name="first_name" placeholder="نام"
                                            data-vv-delay="500" v-model="user.first_name">
                                    <br>
                                    <div v-show="errors.has('first_name')" class="alert alert-danger" role="alert">{{ "نام باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- First Name -->
                            <!-- Last Name -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('last_name')}"
                                             dir="rtl" type="text" id="last_name" class="form-controller" name="last_name" placeholder="نام خانوادگی"
                                             data-vv-delay="500" v-model="user.last_name">
                                    <br>
                                    <div v-show="errors.has('last_name')" class="alert alert-danger" role="alert">{{ "نام خانوادگی باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Last Name -->
                            <!-- Email -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.EMAIL}" :class="{'input': true, 'is-danger': errors.has('email')}"
                                            dir="ltr" type="email" id="email" class="form-controller" name="email" placeholder="ایمیل"
                                            data-vv-delay="500" v-model="user.email">
                                    <br>
                                    <div v-show="errors.has('email')" class="alert alert-danger" role="alert">{{ "لطفا آدرس ایمیل خود را به درستی وارد کنید" }}</div>
                                </div>
                            </div><!-- Email -->
                            <!-- Password -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.PASSWORD}" :class="{'input': true, 'is-danger': errors.has('password')}"
                                            dir="ltr" type="password" id="password" class="form-controller" name="password" placeholder="رمزعبور"
                                            data-vv-delay="500" v-model="user.password">
                                    <br>
                                    <div v-show="errors.has('password')" role="alert" class="alert alert-danger">{{ "رمزعبور باید بیش از ۸ کاراکتر باشد" }}</div>
                                </div>
                            </div><!-- Password -->
                            <!-- Password Confirm -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.PASSWORD}" :class="{'input': true, 'is-danger': errors.has('password_c')}"
                                            dir="ltr" type="password" id="password_c" class="form-controller" name="password_c" placeholder="تکرار رمزعبور"
                                            data-vv-delay="500" v-model="user.password_c">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('password_c')">{{ "رمزعبور همخوانی ندارد" }}</div>
                                </div>
                            </div><!-- Password Confirm -->
                            <!-- Username -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.USERNAME}" :class="{'input': true, 'is-danger': errors.has('username')}"
                                            dir="ltr" type="text" id="username" class="form-controller" name="username" placeholder="نام کاربری"
                                            data-vv-delay="500" v-model="user.username">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('username')">{{ "نام کاربری باید به زبان انگلیسی باشد" }}</div>
                                </div>
                            </div><!-- Username -->
                            <!-- Bussiness -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('bussiness')}"
                                            dir="rtl" type="text" id="bussiness" class="form-controller" name="bussiness" placeholder="نام تجاری"
                                            data-vv-delay="500" v-model="user.bussiness">
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('bussiness')">{{ "نام تجاری باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Bussiness -->
                            <!-- Phone -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.PHONE}" :class="{'input': true, 'is-danger': errors.has('phone')}"
                                            dir="ltr" type="text" id="phone" class="form-controller" name="phone" placeholder="تلفن همراه"
                                            data-vv-delay="500" v-model="user.phone">
                                    <div class="alert alert-danget" role="alert" v-show="errors.has('phone')">{{ "لطفا با پیش شماره وارد کیند" }}</div>
                                </div>
                            </div><!-- Phone -->
                            <!-- Mobile -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.MOBILE}" :class="{'input': true, 'is-danger': errors.has('phone')}"
                                            dir="ltr" type="text" id="phone" class="form-controller" name="phone" placeholder="تلفن همراه"
                                            data-vv-delay="500" v-model="user.mobile">
                                    <div class="alert alert-danget" role="alert" v-show="errors.has('phone')">{{ "لطفا به صورت ۰۹۱۲۰۰۰۰۰۰۰ وارد کنید" }}</div>
                                </div>
                            </div><!-- Mobile -->
                            <button type="submit" class="btn btn-success btn-block">ثبت نام</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: Register
*/
import fa from 'vee-validate/dist/locale/fa'
import {VALIDATIONS} from '../../config';

export default {
    name: 'register',

    data() {
        return {
            msg: 'ایجاد حساب کاربری',
            first_name: '',
            last_name: '',
            email: '',
            validation: {...VALIDATIONS},
            password: '',
            phone: '',
            username: '',
            bussiness: ''
        };
    },

    created() {
        window.document.title = 'ثبت نام در ایراینان مگنت';

        const dict = {
            fa: {
                messages: {
                    required: 'الزامی است'
                },
                attributes: {
                    first_name: 'نام',
                    last_name: 'نام خانوادگی',
                    email: 'ایمیل',
                    password: 'رمزعبور',
                    phone: 'شماره تلفن',
                    username: 'نام کاربری',
                    bussiness: 'نام تجاری'
                }
            }
        };
        this.$validator.localize('fa', dict);
    },

    methods: {
        getData(frm) {
            //
        }
    }
}
</script>

<style scoped>
.centered-form{
	margin-top: 40px;
}

.centered-form .panel{
	background: rgba(255, 255, 255, 0.8);
	box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
}
</style>
