import Vue from 'vue';
import Vuex from 'vuex';
import articleList from './modules/post.blog';
import productsAll from './modules/productsAll';


Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        articleList,
        productsAll
    }
});
