<template>
    <div>
        <div v-if="alert_msg" class="alert alert-warning text-center" role="alert">
            {{ alert_msg }}
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h1 class="msg-font text-center">{{ alert_msg }}</h1>
            </div>
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
            this.$ls.remove('info');
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

<style scoped>
.msg-font {
    font-size: 5em;
}
</style>
