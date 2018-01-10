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
                                <button type="button" class="btn btn-danger" v-if="checkedList.length > 0"><i class="glyphicon glyphicon-trash"></i></button>
                                <div class="dropdown filterbox" :class="{ 'open': filterToggle }">
                                    <button type="button" class="btn btn-success" v-on:click="filterToggle = !filterToggle"><i class="glyphicon glyphicon-filter"></i></button>
                                    <ul class="dropdown-menu list-group">
                                        <li class="list-group-item">
                                            <label>Filter by Status</label>
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" value="actived" v-model="filterByStatus"> Actived
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" value="deactived" v-model="filterByStatus"> Deactived
                                        </li>
                                        <li class="list-group-item">
                                            <input type="checkbox" value="created" v-model="filterByStatus"> Created
                                        </li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-primary" v-on:click="openModal()"><i class="glyphicon glyphicon-plus"></i></button>
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
                                <th width="50" v-on:click="sortById = !sortById">ID <i class="pull-right glyphicon" :class="[sortById?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th v-on:click="sortByName = !sortByName">Name <i class="pull-right glyphicon" :class="[sortByName?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th v-on:click="sortByOld = !sortByOld">Old <i class="pull-right glyphicon" :class="[sortByOld?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th v-on:click="sortByEmail = !sortByEmail">Email <i class="pull-right glyphicon" :class="[sortByEmail?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th v-on:click="sortByStatus = !sortByStatus">Status <i class="pull-right glyphicon" :class="[sortByStatus?'glyphicon-sort-by-alphabet-alt':'glyphicon-sort-by-alphabet']"></i></th>
                                <th width="105" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in listView" :class="{'warning':checkedList.includes(item.id)}">
                                <td align="center">
                                    <input type="checkbox" :value="item.id" v-model="checkedList">
                                </td>
                                <td align="center"><b>{{ item.id }}</b></td>
                                <td v-text="item.name"></td>
                                <td v-text="item.old"></td>
                                <td v-text="item.email"></td>
                                <td v-text="item.status"></td>
                                <td>
                                    <button type="button" class="btn btn-warning" v-on:click="openModal(item)"><i class="glyphicon glyphicon-edit"></i></button>
                                    <button type="button" class="btn btn-danger" v-on:click="deleting(index)"><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <modal v-if="showModal" v-on:close="showModal = false">
                        <h3 slot="title">{{ modalType==1?'Add':'Edit' }} Item</h3>
                        <div slot="body" :class="{ 'has-error':isFormValid }">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group" :class="{ 'has-success':item.id!=null && isFormValid }">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                            </span>
                                            <input type="text" class="form-control" readonly disabled v-model="item.id">
                                        </div>
                                        <span class="help-block" v-if="item.id == null && isFormValid">Id is invalid!</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" :class="{ 'has-success':item.status && isFormValid }">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                            </span>
                                            <select class="form-control" v-model="item.status">
                                                <option value="created">Created</option>
                                                <option value="actived">Actived</option>
                                                <option value="deactived">Deactived</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" :class="{ 'has-success':item.name!=null && isFormValid }">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Fullname" v-model="item.name">
                                </div>
                                <span class="help-block" v-if="item.name == null && isFormValid">Name is empty!</span>
                            </div>
                            <div class="form-group" :class="{ 'has-success':item.old!=null && isFormValid }">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-time"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Old" v-model="item.old">
                                </div>
                                <span class="help-block" v-if="item.old == null && isFormValid">Old is empty!</span>
                            </div>
                            <div class="form-group" :class="{ 'has-success':item.old!=null && isFormValid && checkEmailValid(item.email) }">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Email Address" v-model="item.email">
                                </div>
                                <span class="help-block" v-if="item.email == null && isFormValid">Email is empty!</span>
                                <span class="help-block" v-else-if="!checkEmailValid(item.email) && isFormValid">Email is invalid!</span>
                            </div>
                            <button type="button" class="btn btn-primary" v-on:click="submit(item)">Submit</button>
                        </div>
                        <!-- <div slot="footer" class="text-center"></div> -->
                    </modal>
                </div>
            </div>
        </main>

        <!-- template for the modal component -->
        <script type="text/x-template" id="modal-template">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" v-on:click="$emit('close')"><span aria-hidden="true">&times;</span></button>
                                <slot name="title">Modal Title</slot>
                            </div>
                            <div class="modal-body">
                                <slot name="body"></slot>
                            </div>
                            <div class="modal-footer">
                                <slot name="footer"></slot>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </script>
    </div>
</template>

<script>
// TODO: Make this component usable
// TODO: Make a component for modal
var list = [
	{
		id: 1,
		name: 'a',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'deactived'
	},
	{
		id: 2,
		name: 'b',
		old: 20,
		email: 'ttquoccuong@gmail.com',
		status: 'actived'
	},
	{
		id: 3,
		name: 'c',
		old: 16,
		email: 'ttquoccuong@gmail.com',
		status: 'actived'
	},
	{
		id: 4,
		name: 'e',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'created'
	},
	{
		id: 5,
		name: 'b',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'deactived'
	},
	{
		id: 6,
		name: 'a',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'actived'
	},
	{
		id: 7,
		name: 'g',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'created'
	},
	{
		id: 8,
		name: 'd',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'deactived'
	},
	{
		id: 9,
		name: 'p',
		old: 18,
		email: 'ttquoccuong@gmail.com',
		status: 'deactived'
	}
];

Vue.component('modal', {
	template: '#modal-template'
});

export default {
    name: 'table',

    data() {
        return {
            list: list,
            item: {},
            checkedList: [],
            filterToggle: false,
            filterByName: [],
            filterByStatus: [],
            sortById: false,
            sortByName: false,
            sortByOld: false,
            sortByStatus: false,
            sortByEmail: false,
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
				return self.list.filter(function(item) {
					return self.filterByName.indexOf(item.name) > -1 || self.filterByStatus.indexOf(item.status) > -1;
				});
			} else {
				return self.list;
			}
        },

        checkedAll:  {
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
		sortByOld: function (val) {
			var self = this;
			self.listView = self.sortBy(self.listView, 'old', val);
		},
		sortByEmail: function (val) {
			var self = this;
			self.listView = self.sortBy(self.listView, 'email', val);
		},
		sortByStatus: function (val) {
			var self = this;
			self.listView = self.sortBy(self.listView, 'status', val);
		}
    },
    
    methods: {
		sortBy: function(array, param, reverse) {
			var filterA, filterB;
			return array.sort(function (a, b) {
				switch (param) {
					case 'id':
						filterA = a.id;
						filterB = b.id;
						break;
					case 'name':
						filterA = a.name;
						filterB = b.name;
						break;
					case 'old':
						filterA = a.old;
						filterB = b.old;
						break;
					case 'status':
						filterA = a.status;
						filterB = b.status;
						break;
				}
				if (reverse) {
					return (filterA > filterB) ? 1 : -1;
				} else {
					return (filterA < filterB) ? 1 : -1;
				}
			});
		},
		checkEmailValid: function (email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      		return re.test(email);
		},
		openModal: function (item) {
			var self = this;
			if (item) {
				self.item = item;
				self.modalType = 2;
			} else {
				self.item = {
					id: self.list[self.list.length - 1].id + 1,
					name: null,
					old: null,
					email: null,
					status: 'created'
				};
				self.modalType = 1;
			}
			self.showModal = true;
		},
		submit: function (item) {
			var self = this;
			if (item.id == null
				|| item.name == null
				|| item.old == null
				|| item.email == null
				|| !self.checkEmailValid(item.email)) {
				self.isFormValid = true;
			} else {
				if (self.modalType == 1) {
					self.list.push(item);
				} else if (self.modalType == 2) {
					self.list.find(function (value, index) {
						if (value.id == item.id) {
							self.list[index] = item;
						}
					});
				} else {
					return;
				}
				self.item = {};
				self.showModal = false;
			}
		},
		deleting: function (index) {
			var self = this;
			var confirmDelete = confirm("Are you sure to delete this?");
			if (confirmDelete) {
				self.list.splice(index, 1);
			}
		}
	}
}

new Vue({
	el: '#ssfcrud',
});
</script>

<style>
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

/* #header {}
#main {}
#footer {} */

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
