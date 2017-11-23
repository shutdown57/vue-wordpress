import Vue from 'vue';
import VueResource from 'vue-resource';
import { API_ROUTES } from '../config';

Vue.use(VueResource);


Vue.http.options.crossOrigin = true;
Vue.http.options.credentials = true;

// Vue.http.interceptors.push(function(request, next) {

//     // modify method
//     // request.method = 'POST';

//     // modify headers
//     request.headers.set('X-WP-Nonce', nonce);
//     // request.headers.set('Authorization', 'Bearer TOKEN');

//     // continue to next interceptor
//     next();
// });

export const CategoriesAllResource = Vue.resource(API_ROUTES + 'categories');
export const CategoriesIdResource = Vue.resource(API_ROUTES + 'categories/{id}');

export const CommentsAllResource = Vue.resource(API_ROUTES + 'comments{/post}');
export const CommentsIdResource = Vue.resource(API_ROUTES + 'comments{/id}');

// TODO MediaAllResource should get the media of post or page
export const MediaAllResource = Vue.resource(API_ROUTES + 'media{/media_type}');
export const MediaIdResource = Vue.resource(API_ROUTES + 'media/{id}');

export const PagesAllResource = Vue.resource(API_ROUTES + 'pages');
export const PagesIdResource = Vue.resource(API_ROUTES + 'pages{/id}');
export const PagesRevisionsAllResource = Vue.resource(API_ROUTES + 'pages{/parent}/revisions');
export const PagesRevisionsIdResource = Vue.resource(API_ROUTES + 'pages{/parent}/revisions{/id}');

export const PostsAllResource = Vue.resource(API_ROUTES + 'posts?categories={categories}&categories_exclude={ex_categories}');
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
