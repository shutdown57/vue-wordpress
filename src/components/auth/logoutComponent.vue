<template>
    <div>
        <div v-if="alert_msg" class="alert alert-danger text-center" role="alert">
            {{ alert_msg }}
        </div>
    </div>
</template>


<script>
/**
 * @component: Logout
 */
import User from '../../mixins/user';

export default {
    name: 'logout',

    data() {
        return {
            alert_msg: 'شما از اکانت خود خارج شدید'
        };
    },

    created() {
        User.clearData();
        setTimeout(() => {
            this.$router.push({name: 'home'});
        }, 2000);
    }
}
</script>