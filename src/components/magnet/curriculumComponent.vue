<template>
  <div>{{msg}}</div>
</template>

<script>
/**
 * @component: Curriculum
*/
import {mapActions, mapState} from 'vuex';

export default {
    name: 'curriculum',
    data() {
        return {
            msg: 'نمونه کار‌های برنامه‌درسی'
        };
    },

    created() {
        window.document.title = 'برنامه درسی'
    }
}
</script>

<style>

</style>
