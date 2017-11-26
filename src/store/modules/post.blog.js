import api from '../../api';
import {
    ARTICLE_LIST, GET_ARTICLE_LIST_FAILURE,
    REQUEST_ARTICLE_LIST
} from '../types';


const state = {
    items: [],
    isFetching: true,
    isMore: false
};

const actions = {
    getPostsBlog({commit}) {
        api.getPostsAll(1, 0).then(res => {
            if ( !res.ok ) {
                return commit(GET_ARTICLE_LIST_FAILURE);
            }
            // console.log(res);

            // Fetch image info from the server
            res.body.map((cur_main, i_main, val_main) => {
                // Thumbnail Handling
                api.getMediaId(cur_main.featured_media).then(res =>{
                    // Thumbnail url
                    cur_main.img_url = res.body.source_url;
                    // Thumbnail title
                    cur_main.img_title = res.body.title.rendered;
                    // console.log(res.body);
                }, (rej) => {
                    cur_main.featured_media = cur_main.featured_media;
                });

                // Categories Handling
                cur_main.cats = [];
                api.getCategoriesId(cur_main.catgories).then((res) => {
                    res.body.map((cur_cat, i_cat, val_cat) => {
                        cur_main.cats.push({
                            name: cur_cat.name,
                            link: cur_cat.link
                        });
                    });
                    // console.log(res);
                }, (rej) => {
                    // console.log(rej);
                });

                // Tags Handling
                cur_main.post_tags = [];
                cur_main.tags.map((cur_tag, i_tag, val_tag) => {
                    // console.log(cur_tag);
                    api.getTagsId(cur_tag).then((res) => {
                        cur_main.post_tags.push({
                            name: res.body.name,
                            link: res.body.link
                        });
                        // console.log(res);
                    }, (rej) => {
                        // console.error(rej);
                    });
                });

            });
            const json = res.body;
            // const isMore = !(json.data.length < );
            commit(ARTICLE_LIST, {
                articleList: json,
                isMore: false
            });
        }, rej => {
            commit(GET_ARTICLE_LIST_FAILURE);
        });
    }
};

const mutations = {
    [REQUEST_ARTICLE_LIST](state){
        state.isFetching = true;
    },

    [ARTICLE_LIST](state, action){
        state.isFetching = false;
        state.isMore = action.isMore;
        state.items = action.articleList;
    },

    [GET_ARTICLE_LIST_FAILURE](state){
        state.isFetching = false;
    }
};

export default {
    state,
    actions,
    mutations
};
