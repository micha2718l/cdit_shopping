<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shopping List - View List</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/angular.min.js"></script>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>

<body ng-app="listApp">

    <div ng-controller="listController as ctrl">
        <div ng-show="ctrl.debug">
            status: {{ ctrl.status }}<br />
            updateItem: {{ ctrl.updateItem }}<br />
            currentOrder: {{ ctrl.currentOrder }} <br />
        </div>
        <h1>
            Super cool shopping list app.
        </h1>
        <h2>
            {{ ctrl.lists[ctrl.currentList].list_name }}
        </h2>
        <h3>
            {{ ctrl.lists[ctrl.currentList].description }}
        </h3>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>List ID</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Item</th>
                    <th>Update?</th>
                    <th>Delete?</th>
                </tr>
            </thead>
            <tr ng-repeat="item in ctrl.list | orderBy : ctrl.currentOrder.field : ctrl.currentOrder.direction">
                <td>{{ item.id }}</td>
                <td>{{ item.list_id }}</td>
                <td>{{ item.created }}</td>
                <td>{{ item.modified }}</td>
                <td>{{ item.item }}</td>
                <td>
                    <button type="button" class="btn btn-primary" ng-click="ctrl.setUpdateItem(item)"
                            data-toggle="modal" data-target="#myModal">Update</button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" ng-click="ctrl.delete(item.id)">Delete</button>
                </td>
            </tr>
        </table>

        Item to add:<input type="text" ng-model="ctrl.inputItem" />

        <button type="button" class="btn btn-primary" ng-click="ctrl.addItem()">Add</button>
        <br />
        <button type="button" class="btn btn-primary" ng-click="ctrl.refreshList()">Refresh</button>
        <br />
        Select List to Work With:
        <select ng-model="ctrl.selectedList" ng-change="ctrl.setList()">
            <option ng-repeat="list in ctrl.lists" value="{{ list }}">{{ list.list_name }}</option>
        </select>
        Delete current list:
        <button type="button" class="btn btn-danger" ng-click="ctrl.deleteList()">Delete</button>
        <br /><br />
        Add New List Name:
        <input type="text" ng-model="ctrl.newList.list_name" />
        Description:
        <input type="text" ng-model="ctrl.newList.description" />
        <button type="button" class="btn btn-primary"
                ng-click="ctrl.addList(ctrl.newList.list_name, ctrl.newList.description)">
        Add</button>
        <br />
        Sort By:
        <select ng-model="ctrl.currentOrder.field">
            <option ng-repeat="option in ctrl.orderOptions" value="{{ option }}">{{ option }}</option>
        </select>
        <input type="checkbox" ng-model="ctrl.currentOrder.direction" />Reverse?
        <br /><input type="checkbox" ng-model="ctrl.debug" />Debug Mode?

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Item (ID: {{ ctrl.updateItem.id }})</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Original Item: {{ ctrl.updateItem.item }}</p>
                <p>New Item: <input type="text" ng-model="ctrl.updateItem.newItem" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="ctrl.update()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
        </div>

    </div>
    <script src="/js/ang_app.js"></script>

</body>
</html>