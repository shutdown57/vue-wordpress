<template>
        <div>
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading" dir="rtl">
                        <h3 class="panel-title text-center">فرم ثبت نام<small> ثبت نام رایگان میباشد</small></h3>
                    </div>
                    <div class="panel-body">
                        <form dir="rtl" action="#">
                            <!-- Username -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true}" :class="{'input': true, 'is-danger': errors.has('username')}"
                                            dir="ltr" type="text" id="username" class="form-control" name="username" placeholder="نام کاربری"
                                            data-vv-delay="500" v-model="user.username">
                                    <br>
                                    <div class="alert alert-danger" role="alert" v-show="errors.has('username')">{{ "نام کاربری باید به زبان انگلیسی باشد" }}</div>
                                </div>
                            </div><!-- Username -->
                            <!-- Password -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input v-validate="{required: true}" :class="{'input': true, 'is-danger': errors.has('password')}"
                                            dir="ltr" type="password" id="password" class="form-control" name="password" placeholder="رمزعبور"
                                            data-vv-delay="500" v-model="user.password">
                                    <br>
                                    <div v-show="errors.has('password')" role="alert" class="alert alert-danger">{{ "رمزعبور باید بیش از ۸ کاراکتر باشد" }}</div>
                                </div>
                            </div><!-- Password -->
                            <br>
                            <!-- Submit button -->
                            <button type="button" @click="getData(user)" class="btn btn-success btn-block">ورود</button>
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
 * component: Login
 */
import {VALIDATIONS} from '../../config';
import {Base64} from '../../mixins/utils';

export default {
    name: 'login',

    data() {
        return {
            msg: 'ورود به حساب کاربری',
            validation: {...VALIDATIONS},
            user: {
                username: '',
                password: ''
            }
        };
    },

    methods: {
        getData(user) {
            this.$http.get('http://wordpress.app/wp-json/wp/v2/users', { }, {
                method: 'GET',
                params: { username: this.username, password: this.password },
                before: (request) => {
                    request.headers.set('X-WP-Nonce', NONCE);
                    request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                    request.headers.set('Authorization', 'Basic ' + Base64.encode(this.username + ':' + this.password));
                    }
                }).then(res => {
                    console.log(res);
                }, rej => { console.error(rej); });
            
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
