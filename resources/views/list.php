<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shopping List - View List</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/angular.min.js"></script>
</head>

<body ng-app="listApp">

    <div ng-controller="listController as ctrl">
        {{ ctrl.status }}
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>List ID</th>
                    <th>Item</th>
                    <th>Delete?</th>
                </tr>
            </thead>
            <tr ng-repeat="item in ctrl.list">
                <td>{{ item.id }}</td>
                <td>{{ item.list_id }}</td>
                <td>{{ item.item }}</td>
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
    </div>
    <script src="/js/ang_app.js"></script>

</body>
</html>