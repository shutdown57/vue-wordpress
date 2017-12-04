<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>تعداد پستهای مربوط به دسته بندی</th>
                    <th>شماره شناسه دسته بندی</th>
                    <th>توضیحات</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories">
                    <td>{{index + 1}}</td>
                    <td><router-link :to="{name: 'categorySingle', params: {cid: category.id}}">{{category.name}}</router-link></td>
                    <td>{{category.count}}</td>
                    <td>{{category.id}}</td>
                    <td>{{category.description}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
/**
 * @component: All Categories
 */
import api from '../../api';

export default {
    name: 'categories',

    data() {
        return {
            categories: []
        };
    },
    
    created() {
        window.document.title = 'دسته‌بندی‌ها';
        api.getCategoriesAll()
            .then(res => {
                this.categories = res.body;
                console.log(res);
            }, rej => { console.error(rej); });
    }
}
</script>

<style>

</style>
