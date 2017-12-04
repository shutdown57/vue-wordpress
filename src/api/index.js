import {
    CategoriesAllResource, CategoriesIdResource,
    CommentsAllResource, CommentsIdResource,
    MediaAllResource, MediaIdResource,
    PagesAllResource, PagesIdResource,
    PostsAllResource, PostsIdResource,
    StatusesAllResource, StatusesIdResource,
    TagsAllResource, TagsIdResource,
    TaxonomiesAllResource, TaxonomiesIdResource,
    TypesAllResource, TypesIdResource,
    UsersAllResource, UsersIdResource,
    UsersMeResource, SettingsAllResource,
    PostsByTagsResource, PostsByCategoryResource
} from './resources';

export default {
    getPostsByCategory: function (cat_id) {
        return PostsByCategoryResource.get({id: cat_id});
    },
    getPostsByTagId: function(tag_id) {
        return PostsByTagsResource.get({id: tag_id});
    },
    getMediaId: function (id) {
        return MediaIdResource.get({id: id});
    },
    getPostsAll: function (cat_in, cat_out) {
        return PostsAllResource.get({categories: cat_in, ex_categories: cat_out});
    },

    getPostsId: function (id) {
        return PostsIdResource.get({id: id});
    },

    getCategoriesAll: function () {
        return CategoriesAllResource.get();
    },

    getCategoriesId: function (id) {
        return CategoriesIdResource.get({id: id});
    },

    getCommentsAll: function (postId) {
        return CommentsAllResource.get({post: postId});
    },

    getCommentsId: function (id) {
        return CommentsIdResource.get({id: id});
    },

    getPageAll: function () {
        return PagesAllResource.get();
    },

    getPageId: function (id) {
        return PagesIdResource.get({id: id});
    },

    getTagsAll: function () {
        return TagsAllResource.get();
    },

    getTagsId: function (id) {
        return TagsIdResource.get({id: id});
    },

    getTaxonomiesAll: function () {
        return TaxonomiesAllResource.get();
    },

    getTaxonomiesId: function (id) {
        return TaxonomiesIdResource.get({id: id});
    },

    getTypesAll: function () {
        return TypesAllResource.get();
    },

    getTypesId: function (id) {
        return TypesIdResource.get({id: id});
    },

    getUsersId: function (id) {
        return UsersIdResource.get({id: id});
    }
};