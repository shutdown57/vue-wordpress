<template>
    <div>
        <main id="main">
            <div class="container">
                <div id="ssfcrud" v-cloak>
                    <table class="table table-bordered table-hover table-striped table-xs-block">
                        <caption>
                            <div class="pull-right multiple-action">
                                <div class="search">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Search by Name" v-model="filterByName">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="notifications">
                                <p class="alert bg-success" v-if="notification"></p>
                                <p class="alert bg-warning" v-if="checkedAll">
                                    All <strong v-text="checkedList.length"></strong> items checked
                                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </p>
                            </div>
                        </caption>
                        <thead>
                            <tr class="bg-primary">
                                <th width="30" class="text-center"><input type="checkbox" v-model="checkedAll"></th>
                                <th width="50" v-on:click="sortByIndex = !sortByIndex">اندیس </th>
                                <th width="50" v-on:click="sortById = !sortById">ID <i class="pull-right glyphicon" :class="[sortById?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th v-on:click="sortByName = !sortByName">نام <i class="pull-right glyphicon" :class="[sortByName?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th v-on:click="sortByCount = !sortByCount">تعداد پست <i class="pull-right glyphicon" :class="[sortByCount?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th class="text-center">لینک </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in listView" :class="{'warning':checkedList.includes(item.id)}">
                                <td align="center">
                                    <input type="checkbox" :value="item.id" v-model="checkedList">
                                </td>
                                <td align="center"><b>{{ index + 1 }}</b></td>
                                <td align="center"><b>{{ item.id }}</b></td>
                                <td class="text-center" v-text="item.name"></td>
                                <td class="text-center" v-text="item.count"></td>
                                <td class="text-center">
                                    <router-link class="btn btn-success btn-block" :to="{name: 'categorySingle', params: {cid: item.id}}">{{decodeURIComponent(item.slug)}}</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
/**
 * @component: All Categories
 */
import api from '../../api';

export default {
    name: 'categories',

    created() {
        window.document.title = 'دسته‌بندی‌ها';
        api.getCategoriesAll()
            .then(res => {
                this.list = res.body;
            }, rej => { console.log(rej); });
    },

    data() {
        return {
            list: [],
            item: {},
            checkedList: [],
            filterToggle: false,
            filterByName: [],
            filterByStatus: [],
            sortById: false,
            sortByName: false,
            sortByIndex: false,
            sortBySlug: false,
            sortByCount: false,
            notification: false,
            showModal: false,
            modalType: 0,
            isFormValid: false
        };
    },

    computed: {
        listView: function () {
            var self = this;
            if (self.filterByName.length > 0 || self.filterByStatus.length > 0) {
                return self.list.filter(function (item) {
                    return self.filterByName.indexOf(item.name) > -1 || self.filterByStatus.indexOf(item.status) > -1;
                });
            } else {
                return self.list;
            }
        },

        checkedAll: {
            get: function () {
                var self = this;
                if (self.checkedList.length > 0) {
                    return self.listView.length == self.checkedList.length;
                } else {
                    return false;
                }
            },
            set: function (val) {
                var self = this;
                self.checkedList = [];
                if (val) {
                    for (var i = 0; i < self.listView.length; i++) {
                        self.checkedList.push(self.listView[i].id);
                    }
                } else {
                    self.checkedList = [];
                }
            }
        }
    },

    watch: {
        sortById: function (val) {
            var self = this;
            self.listView = self.sortBy(self.listView, 'id', val);
        },
        sortByName: function (val) {
            var self = this;
            self.listView = self.sortBy(self.listView, 'name', val);
        },
        sortByCount: function (val) {
            var self = this;
            self.listView = self.sortBy(self.listView, 'count', val);
        },
        sortByIndex: function (val) {
            var self = this;
            self.listView = self.sortBy(self.listView, 'index', val);
        },
        sortBySlug: function (val) {
            var self = this;
            self.listView = self.sortBy(self.listView, 'slug', val);
        }
    },

    methods: {
        sortBy: function (array, param, reverse) {
            var filterA, filterB;
            return array.sort(function (a, b) {
                switch (param) {
                    case 'id':
                        filterA = a.id;
                        filterB = b.id;
                    case 'name':
                        filterA = a.name;
                        filterB = b.name;
                    case 'count':
                        filterA = a.count;
                        filterB = b.count;
                    case 'index':
                        filterA = a.index;
                        filterB = b.index;
                    case 'slug':
                        filterA = decodeURIComponent(a.slug);
                        filterB = decodeURIComponent(b.slug);
                }
                if (reverse) {
                    return (filterA > filterB) ? 1: -1;
                } else {
                    return (filterA < filterB) ? 1: -1;
                }
            });
        }
    }
}
</script>

<style scoped>
/* global */
*,
*:before,
*:after {
	-webkit-box-sizing: border-box;
	   -moz-box-sizing: border-box;
	        box-sizing: border-box;
}
body {
	font: 400 14px/1.5 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
	color: #333;
}
h1, h3, h4, h5, h6, figure, p {
	margin: 0;
}
a,
a:hover,
a:focus {
	text-decoration: none;
	color: #fff;
}
figure img {
	width: 100%;
	max-width: 100%;
}
iframe,
img {
	vertical-align: top;
}
/*overwrite bootstrap*/
.btn:focus {
	outline: none;
}
.has-success .input-group-addon {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #3c763d;
}
.has-success .form-control {
    border-color: #3c763d;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
[v-cloak] {
	display: none;
}
/*modal component style*/
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}

.multiple-action {
	margin-left: 15px;
}
.filterbox {
	display: inline-block;
	vertical-align: top;
	zoom: 1; /* Fix for IE7 */
	*display: inline; /* Fix for IE7 */
}
.filterbox .dropdown-menu {
	padding: 0;
	left: auto;
	right: 0;
}
.search {
	display: inline-block;
	vertical-align: top;
	zoom: 1; /* Fix for IE7 */
	*display: inline; /* Fix for IE7 */
	max-width: 260px;
}
@media (max-width: 480px) {
  .table-xs-block tr th {
    display: none;
  }
  .table-xs-block tr {
    display: block;
    position: relative;
  }
  .table-xs-block tr td {
    display: block;
    text-align: left;
    overflow: hidden;
    margin-left: 30px;
    margin-right: 60px;
  }
  .table-xs-block tr td[data-label]:before {
    content: attr(data-label);
    display: inline-block;
    font-weight: 700;
    min-width: 50px;
  }
  .table-xs-block tr td:first-child,
  .table-xs-block tr td:last-child {
    width: 30px;
    margin-left: 0;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    margin: 0;
  }
  .table-xs-block tr td:last-child {
    left: auto;
    right: 0;
    width: 60px;
  }
}
</style>
