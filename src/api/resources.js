import Vue from 'vue';
import VueResource from 'vue-resource';
import { API_ROUTES } from '../config';

Vue.use(VueResource);


Vue.http.options.crossOrigin = true;
Vue.http.options.credentials = true;
Vue.http.options.emulateHTTP = true;

export const CategoriesAllResource = Vue.resource(API_ROUTES + 'categories');
export const CategoriesIdResource = Vue.resource(API_ROUTES + 'categories/{id}');

export const CommentsAllResource = Vue.resource(API_ROUTES + 'comments{/post}');
export const CommentsIdResource = Vue.resource(API_ROUTES + 'comments{/id}');

export const MediaAllResource = Vue.resource(API_ROUTES + 'media{/media_type}');
export const MediaIdResource = Vue.resource(API_ROUTES + 'media/{id}');

export const PagesAllResource = Vue.resource(API_ROUTES + 'pages');
export const PagesIdResource = Vue.resource(API_ROUTES + 'pages/{id}');
export const PagesRevisionsAllResource = Vue.resource(API_ROUTES + 'pages{/parent}/revisions');
export const PagesRevisionsIdResource = Vue.resource(API_ROUTES + 'pages{/parent}/revisions{/id}');

export const PostsAllResource = Vue.resource(API_ROUTES + 'posts?categories={categories}&categories_exclude={ex_categories}');
export const PostsByCategoryResource = Vue.resource(API_ROUTES + 'posts?categories={id}');
export const PostsByTagsResource = Vue.resource(API_ROUTES + 'posts?tags={id}');
export const PostsIdResource = Vue.resource(API_ROUTES + 'posts/{id}');
export const PostsRevisionsAllResource = Vue.resource(API_ROUTES + 'posts{/parent}/revisions');
export const PostsRevisionsIdResource = Vue.resource(API_ROUTES + 'posts{/parent}/revisions{/id}');

export const SettingsAllResource = Vue.resource(API_ROUTES + 'settings');

export const StatusesAllResource = Vue.resource(API_ROUTES + 'statuses');
export const StatusesIdResource = Vue.resource(API_ROUTES + 'statuses{/id}');

export const TagsAllResource = Vue.resource(API_ROUTES + 'tags');
export const TagsIdResource = Vue.resource(API_ROUTES + 'tags/{id}');

export const TaxonomiesAllResource = Vue.resource(API_ROUTES + 'taxonomies');
export const TaxonomiesIdResource = Vue.resource(API_ROUTES + 'taxonomies{/id}');

export const TypesAllResource = Vue.resource(API_ROUTES + 'types');
export const TypesIdResource = Vue.resource(API_ROUTES + 'types{/id}');

export const UsersAllResource = Vue.resource(API_ROUTES + 'users');
export const UsersIdResource = Vue.resource(API_ROUTES + 'users{/id}');
export const UsersMeResource = Vue.resource(API_ROUTES + 'users/me');


/**
 * New 
 */
// Better to make file like this part -> in future ;)
// start =>
const Actions = {
    
    getAllPosts: {
        method: 'GET',
        url: API_ROUTES + 'posts?categories={categories}&categories_exclude={ex_categories}&page={current_page}' 
    },
    
    getOnePost: {
        method: 'GET',
        url: API_ROUTES + 'posts/{id}'
    },

    getPostsByTags: {
        method: 'GET',
        url: API_ROUTES + 'posts?tags={id}'
    }
};

export const postResources = Vue.resource('url', {}, Actions);
// end
