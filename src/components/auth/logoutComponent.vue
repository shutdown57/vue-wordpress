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
            alert_msg: 'شما از اکانت خود خارج شدید',
            isLogged: this.checkToken()
        };
    },

    created() {
        User.clearData();
        this.isLogged = this.checkToken();
        this.logout();
        setTimeout(() => {
            this.$router.push({name: 'home'});
        }, 2000);
    },

    methods: {
        logout() {
            this.$ls.remove('access_token');
            this.isLogged = this.checkToken();
        },

        checkToken() {
            let token = this.$ls.get('access_token');
            if (token) {
                return true;
            } else {
                return false;
            }
        }
    }
}
</script>