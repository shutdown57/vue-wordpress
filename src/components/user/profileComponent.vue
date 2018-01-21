<template>
    <div>User Profile
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
            user_: {}
        };
    },

    methods: {
        getUser() {
            let user = this.$ls.get('info', false);
            if (user) {
                this.user_ = {...user};
            }
        }
    },

    mounted() {
        this.getUser();
    }
}
</script>

<style scoped>

</style>
