<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shopping List - View List</title>
    <script src="/js/angular.min.js"></script>
</head>

<body ng-app="listApp">

    <div ng-controller="listController as ctrl">
        {{ ctrl.value }}
        <div ng-repeat="item in ctrl.list">
            {{ item.list_id }} - {{ item.item }}
        </div>

        <form>
            <input type="text" ng-model="ctrl.inputs.list_id" />
            <input type="text" ng-model="ctrl.inputs.item" />

            <button type="button" class="btn" ng-click="ctrl.addItem()">Add</button>
            <button type="button" class="btn" ng-click="ctrl.refreshList(1)">Refresh</button>
        </form>

    </div>
    <script src="/js/ang_app.js"></script>

</body>
</html>