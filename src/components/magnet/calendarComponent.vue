<template>
    <div>
        <h1>{{msg}}</h1>
    </div>
</template>

<script>
/**
 * @component: Calendar
 */
import api from '../../api';

export default {
    name: 'calendar',
    data() {
        return {
            msg: 'نمونه کار‌های تقویم'
        };
    }
}
</script>

<style>

</style>
