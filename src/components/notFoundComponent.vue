<template>
    <div class="direction-rtl">
        <br><br>
        <h1>این صفحه وجود ندارد</h1>
    </div>
</template>

<script>
/**
*   @comment: NotFound
*/

export default {
    name: 'notFound',
    created() {
        window.document.title = "404";
    }
}
</script>

<style scoped>
.direction-rtl {
    direction: rtl;
}
</style>
