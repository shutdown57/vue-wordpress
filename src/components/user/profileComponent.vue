<template>
    <div class="container">
        <h1 dir="rtl">اطلاعات شخصی</h1>
        <br>
        <div dir="rtl" class="row">
            <div class="col-md-6 col-sm-12 col-md-push-6">
                <div class="form-group">
                    <label for="name">نام</label>
                    <input dir="rtl" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.first_name" :disabled="disable.default">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-pull-6">
                <div class="form-group">
                    <label for="name">نام خانوادگی</label>
                    <input dir="rtl" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.last_name" :disabled="disable.default">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-push-6">
                <div class="form-group">
                    <label for="name">ایمیل</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_.__email" :disabled="disable.email">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-pull-6">
                <div class="form-group">
                    <label for="name">نام کاربری</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_.__username" :disabled="disable.username">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-push-6">
                <div class="form-group">
                    <label for="name">نام تجاری</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.bussiness" :disabled="disable.default">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-pull-6">
                <div class="form-group">
                    <label for="name">توضیحات درباره شرکت</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.description" :disabled="disable.default">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-push-6">
                <div class="form-group">
                    <label for="name">تلفن ثابت</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.phone" :disabled="disable.default">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-md-pull-6">
                <div class="form-group">
                    <label for="name">تلفن موبایل</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.mobile" :disabled="disable.default">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="name">آدرس</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_info.address" :disabled="disable.default">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-4">
                <br>
                <button class="btn btn-primary btn-block" @click="editInfo">ویرایش</button>
            </div>
            <div class="col-md-2">
                <br>
                <button class="btn btn-success btn-block" :disabled="disable.accept">تایید</button>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * Profile
 */
import {NONCE} from '../../config';

export default {
    name: 'profile',

    data() {
        return {
            user_: {},
            user_info: {},
            disable: {
                default: true,
                username: true,
                email: true,
                accept: true
            }
        };
    },

    // computed: {
    //     editInfo: function () {
    //         this.disable.name = !this.disable.name;
    //         this.disable.email = !this.disable.email;
    //         this.disable.username = !this.disable.username;
    //         this.disable.accept = !this.disable.accept;
    //     }
    // },

    methods: {
        editInfo() {
            this.disable.name = !this.disable.name;
            this.disable.email = !this.disable.email;
            this.disable.username = !this.disable.username;
            this.disable.accept = !this.disable.accept;
        },
        getUser() {
            let user = this.$ls.get('info', false);
            if (user) {
                this.user_ = {...user};
                // console.log(user.__token);
                // console.log(NONCE);
            }
            this.$http.get('http://wordpress.app/wp-json/info/v1/user_info', 
                {
                    params: {
                        email: user.__email
                    },
                    before: (request) => {
                        request.headers.set('X-WP-Nonce', NONCE);
                        request.headers.set('Content-Type', 'application/x-www-form-urlencoded');
                        request.headers.set('Authorization', 'Basic ' + user.__token);
                    }
                }
                ).then((resp) => {
                    this.user_info = {...resp.body.data.user_info};
                }, (err) => { /*console.error(err);*/ });
        }
    },

    created() {
        window.document.title = 'اطلاعات شخصی';
    },

    mounted() {
        this.getUser();
    }
}
</script>

<style scoped>
.width-200 { width: 200% !important; }
</style>
