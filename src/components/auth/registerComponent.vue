<template>
    <div>
        <div v-if="alert_msg.have" class="alert text-center" :class="alert_msg.success" role="alert">
            {{ alert_msg.msg }}
        </div>
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading" dir="rtl">
                        <h3 class="panel-title text-center">فرم ثبت نام<small> ثبت نام رایگان میباشد</small></h3>
                    </div>
                    <div class="panel-body">
                        <form dir="rtl" action="#">
                            <!-- First Name -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('first_name')}"
                                            dir="rtl" type="text" id="first_name" class="form-control" name="first_name" placeholder="نام"
                                            data-vv-delay="500" v-model="user.first_name">
                                    <br>
                                    <div v-show="errors.has('first_name')" class="alert alert-danger" role="alert">{{ "نام باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- First Name -->
                            <!-- Last Name -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('last_name')}"
                                             dir="rtl" type="text" id="last_name" class="form-control" name="last_name" placeholder="نام خانوادگی"
                                             data-vv-delay="500" v-model="user.last_name">
                                    <br>
                                    <div v-show="errors.has('last_name')" class="alert alert-danger" role="alert">{{ "نام خانوادگی باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Last Name -->
                            <!-- Email -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.EMAIL}" :class="{'input': true, 'is-danger': errors.has('email')}"
                                            dir="ltr" type="email" id="email" class="form-control" name="email" placeholder="ایمیل"
                                            data-vv-delay="500" v-model="user.email">
                                    <br>
                                    <div v-show="errors.has('email')" class="alert alert-danger" role="alert">{{ "لطفا آدرس ایمیل خود را به درستی وارد کنید" }}</div>
                                </div>
                            </div><!-- Email -->
                            <!-- Password -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.PASSWORD}" :class="{'input': true, 'is-danger': errors.has('password')}"
                                            dir="ltr" type="password" id="password" class="form-control" name="password" placeholder="رمزعبور"
                                            data-vv-delay="500" v-model="user.password">
                                    <br>
                                    <div v-show="errors.has('password')" role="alert" class="alert alert-danger">{{ "رمزعبور باید بیش از ۸ کاراکتر باشد" }}</div>
                                </div>
                            </div><!-- Password -->
                            <!-- Password Confirm -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.PASSWORD}" :class="{'input': true, 'is-danger': errors.has('password_c')}"
                                            dir="ltr" type="password" id="password_c" class="form-control" name="password_c" placeholder="تکرار رمزعبور"
                                            data-vv-delay="500" v-model="user.password_c">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('password_c')">{{ "رمزعبور همخوانی ندارد" }}</div>
                                </div>
                            </div><!-- Password Confirm -->
                            <!-- Username -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.USERNAME}" :class="{'input': true, 'is-danger': errors.has('username')}"
                                            dir="ltr" type="text" id="username" class="form-control" name="username" placeholder="نام کاربری"
                                            data-vv-delay="500" v-model="user.username">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('username')">{{ "نام کاربری باید به زبان انگلیسی باشد" }}</div>
                                </div>
                            </div><!-- Username -->
                            <!-- Bussiness -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('bussiness')}"
                                            dir="rtl" type="text" id="bussiness" class="form-control" name="bussiness" placeholder="نام تجاری"
                                            data-vv-delay="500" v-model="user.bussiness">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('bussiness')">{{ "نام تجاری باید به زبان فارسی باشد" }}</div>
                                </div>
                            </div><!-- Bussiness -->
                            <!-- Phone -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.PHONE}" :class="{'input': true, 'is-danger': errors.has('phone')}"
                                            dir="ltr" type="text" id="phone" class="form-control" name="phone" placeholder="تلفن ثابت"
                                            data-vv-delay="500" v-model="user.phone">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('phone')">{{ "لطفا با پیش شماره وارد کیند" }}</div>
                                </div>
                            </div><!-- Phone -->
                            <!-- Mobile -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true, regex: validation.MOBILE}" :class="{'input': true, 'is-danger': errors.has('phone')}"
                                            dir="ltr" type="text" id="mobile" class="form-control" name="mobile" placeholder="تلفن همراه"
                                            data-vv-delay="500" v-model="user.mobile">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('mobile')">{{ "لطفا به صورت ۰۹۱۲۰۰۰۰۰۰۰ وارد کنید" }}</div>
                                </div>
                            </div><!-- Mobile -->
                            
                            <!-- Address -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <textarea v-validate="{regex: validation.NAME}" :class="{'input': true, 'is-danger': errors.has('address')}"
                                            dir="rtl" type="text" id="address" class="form-control" name="address" placeholder="آدرس"
                                            data-vv-delay="500" v-model="user.address"></textarea>
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('mobile')">{{ "آدرس پستی محل کار را وارد کنید." }}</div>
                                </div>
                            </div><!-- Address -->
                            <br>
                            <!-- Submit button -->
                            <!-- <vue-recaptcha sitekey="6Ld88UAUAAAAAA8jM-GSJcN0wHPpmZNqKUdTOP-V"> -->
                                <button type="button" @click="getData(user)" class="btn btn-success btn-block">ثبت نام</button>
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
 * @component: Register
*/
import fa from 'vee-validate/dist/locale/fa';
import VueRecaptcha from 'vue-recaptcha';
import {VALIDATIONS, NONCE} from '../../config';
import User from '../../mixins/user';

export default {
    name: 'register',

    components: {
        VueRecaptcha
    },

    data() {
        return {
            msg: 'ایجاد حساب کاربری',
            validation: {...VALIDATIONS},
            alert_msg: {
                have: false,
                type: '',
                msg: ''
            },
            user: {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_c: '',
                phone: '',
                mobile: '',
                username: '',
                bussiness: '',
                address: ''
            }
        };
    },

    created() {
        window.document.title = 'ثبت نام در ایراینان مگنت';
    },

    methods: {
        getData(user) {
            User.setUserInfo(
                user.first_name + ' ' + user.last_name,
                user.username, '', user.email
            );

            if (user.password === user.password_c){
                this.$http.post('http://wordpress.app/wp-json/wp/v2/users', { }, {
                method: 'POST',
                params: {
                    username: user.username,
                    password: user.password,
                    email: user.email,
                    description: '',
                    first_name: user.first_name,
                    last_name: user.last_name
                },
                before: (request) => {
                    request.headers.set('X-WP-Nonce', NONCE);
                    request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                }
                }).then(res => {
                    this.alert_msg.have = true;
                    this.alert_msg.success = 'alert-success';
                    this.alert_msg.msg = 'اطلاعات به درستی فرستاده شد';
                }, rej => { 
                    this.alert_msg.have = true;
                    this.alert_msg.success = "alert-danger";
                    this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                });

                this.$http.get('http://wordpress.app/wp-json/complete/v1/register', {
                    method: 'GET',
                    params: {
                        email: user.email,
                        phone: user.phone,
                        mobile: user.mobile,
                        address: user.address,
                        bussiness: user.bussiness
                    },
                    before: (request) => {
                        request.headers.set('X-WP-Nonce', NONCE);
                        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    }
                }).then((resp) => {
                    this.alert_msg.have = true;
                    this.alert_msg.success = "alert-succuss";
                    this.alert_msg.msg = 'اطلاعات به درستی فرستاده شد';
                }, (err) => { 
                    this.alert_msg.have = true;
                    this.alert_msg.success = "alert-danger";
                    this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                });

                this.$router.push({name: 'login'});
            } else {
                this.alert_msg.have = true;
                this.alert_msg.success = "alert-danger";
                this.alert_msg.msg = 'فیلد رمزعبور را باز بینی کنید.';
            }
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
