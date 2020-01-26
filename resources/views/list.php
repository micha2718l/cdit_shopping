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
        {{ ctrl.status }} / {{ ctrl.updateItem }}
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>List ID</th>
                    <th>Item</th>
                    <th>Update?</th>
                    <th>Delete?</th>
                </tr>
            </thead>
            <tr ng-repeat="item in ctrl.list">
                <td>{{ item.id }}</td>
                <td>{{ item.list_id }}</td>
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

        <form>
            <input type="text" ng-model="ctrl.inputs.list_id" />
            <input type="text" ng-model="ctrl.inputs.item" />

            <button type="button" class="btn btn-primary" ng-click="ctrl.addItem()">Add</button>
        </form>
        <form>
            <button type="button" class="btn btn-primary" ng-click="ctrl.refreshList(1)">Refresh</button>
        </form>


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