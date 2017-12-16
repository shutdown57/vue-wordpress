<template>
    <div>
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">فرم ثبت نام<small> ثبت نام رایگان میباشد</small></h3>
                    </div>
                    <div class="panel-body">
                        <form dir="rtl">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="text" id="first_name" class="form-controller" name="first_name" placeholder="نام">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="text" id="last_name" class="form-controller" name="last_name" placeholder="نام خانوادگی">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="email" id="email" class="form-controller" name="email" placeholder="ایمیل">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="password" id="password_c" class="form-controller" name="password_c" placeholder="تکرار رمزعبور">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="password" id="password" class="form-controller" name="password" placeholder="رمزعبور">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="text" id="description" class="form-controller" name="description" placeholder="توضیحات">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="text" id="username" class="form-controller" name="username" placeholder="نام کاربری">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input dir="rtl" type="text" id="name" class="form-controller" name="name" placeholder="نام تجاری">
                                </div>
                            </div>
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
export default {
    name: 'register',
    data() {
        return {
            msg: 'ایجاد حساب کاربری'
        };
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
