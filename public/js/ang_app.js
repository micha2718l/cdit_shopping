angular
.module('listApp', [])
.controller('listController', ['$http', function($http) {
    this.value = 42;
    this.list = {};
    this.inputs = {list_id: 1, item: ""};

    this.refreshList = function (list_id) {
        console.log('refreshing ' + list_id);
        var self = this;
        $http.get('/api/list/' + list_id)
        .then(function(response) {
            self.list = response.data;//response.data;
        });
    };

    this.addItem = function() {
        this.value = 23;
        var self = this;
        $http({
            method: 'post',
            url: '/api/additem',
            data: JSON.stringify({
                list_id: this.inputs.list_id, item: this.inputs.item
            }),
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            self.value = response.data;
        }).catch(function (response) {
            self.value = 'error';
        });
    }

}]);