<template>
    <div>
        <!-- <h1>{{postDetails.title.rendered}}</h1> -->
        <div class="row">
            <div class="col-xs-4">
                <!-- <img :src="" :alt=""> -->
            </div>
            <div class="col-xs-8">
                <!-- <div v-html="postDetails.content.rendered"></div> -->
            </div>
        </div>
        {{postDetails}}
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
            // postDetails: ({postDetails}) => postDetails
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
            // this.getPostDetails(pid);
            return pid;
        },
        print() {
            console.log(this.postDetails);
        }
    },

    data() {
        return {
            postDetails: {}
        };
    },

    created() {
        let id = this.initParam();
        this.$http.get(API_ROUTES + 'posts/' + id)
            .then((res) => {
                // console.log(res);
                // Handling Thumbnail
                res.body.img_info = [];
                api.getMediaId(res.body.featured_media)
                    .then((resolve) => {
                        console.log(resolve.body);
                        res.body.img_info.push({
                            url: resolve.body.source_url,
                            title: resolve.body.title.rendered
                        })
                    }, (reject) => {
                        // console.log(reject.status);
                    });

                // Handling Categories
                res.body.cats = [];
                api.getCategoriesId(res.body.catgories)
                    .then(resolve => {
                        resolve.body.map((cur_cat, i_cat, arr_cat) => {
                            res.body.cats.push({
                                name: cur_cat.name,
                                link: cur_cat.link
                            });
                        });
                    }, reject => {
                        //
                    });
                this.postDetails = {...res.body};
            }, (rej) => {
                console.log(rej.status);
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

img {
    width: 128px;
    height: 128px;
}
</style>
