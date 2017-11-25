import Vue from 'vue';
import Vuex from 'vuex';
import articleList from './modules/post.blog';
import article from './modules/post.blog.single';


Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        articleList,
        article
    }
});
