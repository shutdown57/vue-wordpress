import api from '../../api';
import {
    GET_PRODUCT_LIST_FAILURE, PRODUCT_LIST
} from '../types';
import {
    PRODUCT_CATEGORIES_IN, PRODUCT_CATEGORIES_OUT
} from '../staticsCategories';

const state = {
    items: []
};

const actions = {
    getProductList({commit}) {
        api.getPostsAll(PRODUCT_CATEGORIES_IN, PRODUCT_CATEGORIES_OUT)
            .then(res => {
                if (!res.ok) {
                    return commit(GET_PRODUCT_LIST_FAILURE);
                }
                // console.log(res.body);
                commit(PRODUCT_LIST, {
                    productList: res.body
                });
            }, rej => {
                return commit(GET_PRODUCT_LIST_FAILURE);
            });
    }
};

const mutations = {
    [PRODUCT_LIST](state, action) {
        state.items = action.productList;
        // console.log(state.items);
    },
    [GET_PRODUCT_LIST_FAILURE]() {
        state.items = 'مشکلی در ارتباط وجود دارد.';
    }
};

export default {
    state,
    actions,
    mutations
};
