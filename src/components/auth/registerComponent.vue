<template>
    <div class="bg-color">
        <div dir="rtl">
            <h1>ثبت نام</h1>
            <hr>
        </div>
        <form dir="rtl">
            <div>
                لطفا اطلاعات را با دقت وارد نمایید
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="first_name">نام</label>
                        <input type="text" id="first_name" class="form-controller" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">نام خانوادگی</label>
                        <input type="text" id="last_name" class="form-controller" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="description">توضیحات</label>
                        <input type="text" id="description" class="form-controller" name="description">
                    </div>
                    <div class="form-group">
                        <label for="name">نام تجاری</label>
                        <input type="text" id="name" class="form-controller" name="name">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="username">نام کاربری</label>
                        <input type="text" id="username" class="form-controller" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" id="email" class="form-controller" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">رمزعبور</label>
                        <input type="password" id="password" class="form-controller" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_c">تکرار رمزعبور</label>
                        <input type="password" id="password_c" class="form-controller" name="password_c">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-2 col-md-offset-5">
                    <button type="submit" class="btn btn-success btn-block">ثبت نام</button>
                </div>
            </div>
        </form>
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

<style>
.bg-color{
    background-color: #525252;
}
.centered-form{
	margin-top: 60px;
}

.centered-form .panel{
	background: rgba(255, 255, 255, 0.8);
	box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
}
</style>
