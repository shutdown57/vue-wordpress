import api from '../../api';
import {
    ARTICLE_LIST, GET_ARTICLE_LIST_FAILURE,
    REQUEST_ARTICLE_LIST
} from '../types';
import {BLOG_CATEGORY} from '../staticsCategories';

const state = {
    items: [],
    isFetching: false,
    isMore: false
};

const actions = {
    getPostsBlog({commit}) {
        let CATEGORIES_OUT = [7, 6, 5, 11, 16, 15, 14, 10, 12, 13, 1, 2];
        api.getPostsAll(BLOG_CATEGORY, CATEGORIES_OUT).then(res => {
            if ( !res.ok ) {
                return commit(GET_ARTICLE_LIST_FAILURE);
            }

            // Fetch image info from the server
            res.body.map((cur_main, i_main, val_main) => {
                // Thumbnail Handling
                cur_main.img_info = [];
                api.getMediaId(cur_main.featured_media).then(resolve =>{
                    cur_main.img_info.push({
                        img_url: resolve.body.source_url,
                        img_title: resolve.body.title.rendered
                    });
                }, (reject) => {
                    cur_main.featured_media = cur_main.featured_media;
                });

                // Categories Handling
                cur_main.cats = [];
                api.getCategoriesId(cur_main.categories).then((resolve) => {
                    cur_main.cats.push({
                        name: resolve.body.name,
                        link: resolve.body.link
                    });
                }, (reject) => {
                    // console.log(rej);
                });

                // Tags Handling
                cur_main.post_tags = [];
                cur_main.tags.map((cur_tag, i_tag, val_tag) => {
                    api.getTagsId(cur_tag).then((resolve) => {
                        cur_main.post_tags.push({
                            name: resolve.body.name,
                            link: resolve.body.link
                        });
                    }, (reject) => {
                        // console.error(rej);
                    });
                });

            });
            const json = res.body;
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
