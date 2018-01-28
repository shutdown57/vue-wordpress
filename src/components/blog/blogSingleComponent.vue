<template>
    <div class="direction-rtl well">
        <div v-if="alert_msg.have" class="alert text-center" :class="alert_msg.type" role="alert">
            {{ alert_msg.msg }}
        </div>
        <h1>{{postDetails.title.rendered}}</h1>
        <div class="row">
            <div class="col-xs-4">
                <img class="img-responsive" :src="postDetails.img_info[0].url" :alt="postDetails.img_info[0].title">
            </div>
            <div class="col-xs-8">
                <div v-html="postDetails.content.rendered"></div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">برچسب‌ها</h4>
                    </div>
                    <div class="panel-body">
                        <a :href="category.link" v-for="category in postDetails.post_tags" class="">
                            <span class="label label-info"> {{category.name}} </span>
                            <span dir="ltr">&nbsp;</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">دسته‌بندی‌ها</h4>
                    </div>
                    <div class="panel-body">
                        <a :href="category.link" v-for="category in postDetails.cats" class="">
                            <span class="label label-info"> {{category.name}} </span>
                            <span dir="ltr">&nbsp;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * @component: SingleBlog
*/
import api from '../../api';
import {API_ROUTES} from '../../config';
import {mapActions, mapState} from 'vuex';


export default {
    name: 'blogSingle',

    computed: {
        ...mapState({
            pid: ({route}) => route.params.pid
        })
    },

    watch: {
        '$route': 'initParam'
    },

    methods: {
        ...mapActions([
            'getPostDetails'
        ]),
        initParam() {
            const pid = this.$route.params.pid;
            return pid;
        }
    },

    data() {
        return {
            postDetails: {},
            alert_msg: {
                have: false,
                msg: '',
                type: ''
            }
        };
    },

    created() {
        let id = this.initParam();
        this.$http.get(API_ROUTES + 'posts/' + id)
            .then((res) => {

                // Handling Thumbnail
                res.body.img_info = [];
                api.getMediaId(res.body.featured_media)
                    .then((resolve) => {
                        res.body.img_info.push({
                            url: resolve.body.source_url,
                            title: resolve.body.title.rendered
                        })
                    }, (reject) => {
                        this.alert_msg.have = true;
                        this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                        this.alert_msg.type = 'alert-danger'
                    });

                // Handling Categories
                res.body.cats = [];
                api.getCategoriesId(res.body.categories)
                    .then(resolve => {
                        res.body.cats.push({
                            name: resolve.body.name,
                            link: resolve.body.link
                        });
                    }, reject => {
                        this.alert_msg.have = true;
                        this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                        this.alert_msg.type = 'alert-danger'
                });

                // Handling Tags
                res.body.post_tags = [];
                res.body.tags.map((cur_tag, i_tag, arr_tag) => {
                    api.getTagsId(cur_tag).then(resolve => {
                        res.body.post_tags.push({
                            name: resolve.body.name,
                            link: resolve.body.link
                        });
                    }, reject => {
                        this.alert_msg.have = true;
                        this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                        this.alert_msg.type = 'alert-danger'
                    });
                });
                this.postDetails = {...res.body};
            }, (rej) => {
                this.alert_msg.have = true;
                this.alert_msg.msg = 'مشکل در ارتباط با سرور';
                this.alert_msg.type = 'alert-danger'
            });
    },

    beforeUpdate() {
        window.document.title = this.postDetails.title.rendered;
    }
}
</script>

<style>
.direction-rtl{
    direction: rtl;
}

a {
    text-decoration: none !important;
}

img {
    width: 256px;
    height: 256px;
}
</style>
