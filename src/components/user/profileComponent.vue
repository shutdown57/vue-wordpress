<template>
    <div class="container">
        <h1 dir="rtl">اطلاعات شخصی</h1>
        <br>
        <div dir="rtl" class="row">
            <div class="col-md-6 col-sd-12 col-md-push-6">
                <div class="form-group">
                    <label for="name">نام و نام خانوادگی</label>
                    <input dir="rtl" class="form-control" type="text" 
                        id="name" name="name" :value="user_.__name" :disabled="disable.name">
                </div>
            </div>
            <div class="col-md-6 col-sd-12 col-md-pull-6">
                <div class="form-group">
                    <label for="name">ایمیل</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_.__email" :disabled="disable.email">
                </div>
            </div>
            <div class="col-md-6 col-sd-12 col-md-push-6">
                <div class="form-group">
                    <label for="name">نام کاربری</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_.__username" :disabled="disable.username">
                </div>
            </div>
            <div class="col-md-6 col-sd-12 col-md-pull-6">
                <div class="form-group">
                    <label for="name">نام کاربری</label>
                    <input dir="ltr" class="form-control" type="text" 
                        id="name" name="name" :value="user_.__username" :disabled="disable.default">
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
export default {
    name: 'profile',

    data() {
        return {
            user_: {},
            disable: {
                default: true,
                name: true,
                email: true,
                username: true,
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
            }
            
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
