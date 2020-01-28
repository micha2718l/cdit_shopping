angular
.module('listApp', [])
.controller('listController', ['$http', function($http) {
    this.status = {add: '', refresh: '', delete: '', update: ''};
    this.list = [];
    this.inputItem = "";
    this.updateItem = {id: null, list_id: null, item: null, newItem: null};
    this.orderOptions = ['item', 'id', 'created', 'modified'];
    this.currentOrder = {field: this.orderOptions[0], direction: false};
    this.debug = false;
    this.currentList = 0;
    this.selectedList = {};
    this.lists = [];

    this.getLists = function () {
        var self = this;
        $http.get('/api/lists/')
        .then(function(response) {
            self.lists = response.data;
            console.log(self.selectedList);
            if (self.lists.length > 0) {
                self.selectedList = JSON.stringify(self.lists[self.currentList]);
                self.refreshList();
            }
        });
    };

    this.setList = function() {
        var selectedListId = JSON.parse(this.selectedList).list_id;
        this.currentList = this.lists.findIndex(function (el) {
            return el.list_id == selectedListId});
        this.refreshList();
    };

    this.refreshList = function () {
        var self = this;
        $http.get('/api/list/' + self.lists[self.currentList].list_id)
        .then(function(response) {

            self.list = response.data;
            self.list.map(function (el) {
                var t = el.created.split(/[- :]/);
                el.created = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                t = el.modified.split(/[- :]/);
                el.modified = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                return el;
            });
        });
    };

    this.addItem = function () {
        var self = this;
        $http({
            method: 'post',
            url: '/api/additem',
            data: JSON.stringify({
                list_id: this.lists[this.currentList].list_id, item: this.inputItem
            }),
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            self.status.add = response.data;
            self.refreshList();
        }).catch(function (response) {
            self.status.add = 'error';
        });
    }

    this.delete = function (id) {
        var self = this;
        $http({
            method: 'delete',
            url: '/api/deleteitem',
            data: JSON.stringify({
                id: id
            }),
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            self.status.delete = response.data;
            self.refreshList();
        }).catch(function (response) {
            self.status.delete = 'error';
        });
    };

    this.setUpdateItem = function (item) {
        this.updateItem.id = item.id;
        this.updateItem.list_id = item.list_id;
        this.updateItem.item = item.item;
        this.updateItem.newItem = item.item;
    };

    this.update = function () {
        var self = this;
        $http({
            method: 'put',
            url: '/api/updateitem',
            data: JSON.stringify({
                id: self.updateItem.id,
                newItem: self.updateItem.newItem
            }),
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            self.status.update = response.data;
            self.refreshList();
        }).catch(function (response) {
            self.status.update = 'error';
        });
    };

    this.getLists();

}]);