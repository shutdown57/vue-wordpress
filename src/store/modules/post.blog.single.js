import api from '../../api';
import {
    GET_ARTICLE_LIST_FAILURE, ARTICLE_DETAIL
} from '../types';

const state = {
    item: {}
};

const actions = {
    getPostDetails({commit}, id) {
        api.getPostsId(id).then((res) => {
            if (res.ok) {
                // console.log(res);
                const post = res.body;
                // const post =
                // console.log(post);
                commit(ARTICLE_DETAIL, {
                    postDetails: post
                });
            }
        }, (rej) => {
            console.error(rej);
        });
    }
};

const mutations = {
    [ARTICLE_DETAIL](state, action) {
        state.item = {...action.postDetails};
        // FIXME This shit doesn't wor
        console.log(state.item);
    }
};

export default {
    state,
    actions,
    mutations
}
