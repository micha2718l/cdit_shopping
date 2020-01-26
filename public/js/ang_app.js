angular
.module('listApp', [])
.controller('listController', ['$http', function($http) {
    this.status = {add: '', refresh: '', delete: '', update: ''};
    this.list = {};
    this.inputs = {list_id: 1, item: ""};

    this.refreshList = function (list_id) {
        var self = this;
        $http.get('/api/list/' + list_id)
        .then(function(response) {
            self.list = response.data;//response.data;
        });
    };

    this.addItem = function () {
        var self = this;
        $http({
            method: 'post',
            url: '/api/additem',
            data: JSON.stringify({
                list_id: this.inputs.list_id, item: this.inputs.item
            }),
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            self.status.add = response.data;
            self.refreshList(1);
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
            self.refreshList(1);
        }).catch(function (response) {
            self.status.delete = 'error';
        });
    };

    this.refreshList(1);

}]);