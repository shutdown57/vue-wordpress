import Vue from 'vue';
import Vuex from 'vuex';
import articleList from './modules/post.blog';


Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        articleList
    }
});
