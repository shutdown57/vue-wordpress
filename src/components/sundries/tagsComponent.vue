<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تعداد مطلب مرتبط</th>
                    <th>شماره شناسه برچسب</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(tag, index) in tags">
                    <td>{{index + 1}}</td>
                    <td><router-link :to="{name: 'tagSingle', params: {tid: tag.id}}">{{tag.name}}</router-link></td>
                    <td>{{tag.count}}</td>
                    <td>{{tag.id}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
/**
 * @component: Tags
 */
import api from '../../api';

export default {
    name: 'tags',

    data() {
        return {
            tags: []
        };
    },

    created() {
        window.document.title = 'برچسبها';
        api.getTagsAll()
            .then(res => {
                // console.log(res);
                this.tags = res.body;
            }, rej => { console.log(res); });
    }
}
</script>

<style>

</style>
