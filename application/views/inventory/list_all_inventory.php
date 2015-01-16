<!--DONE-->
<?php
//$assoc_array = NULL;
//foreach ($categories as $c) {
//    $assoc_array[$c->id] = $c->product_category_name;
//}
?>

<div class="row">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" ng-model="m"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Inventory/add_new'; ?>">Add new Inventory Entry</a>
    </div>
</div>
<br/>

<div ng-controller="InventoryController">
    <table class="table table-hover table-striped">
        <thead>
            <tr style="font-weight: bolder;">
                <td>Id</td>
                <td>Product</td>
                <td>Quantity</td>
                <td>Payment</td>
                <td>Seller</td>
                <td>Date</td>
                <td>Description</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="entry in entries|filter:m">
                <td>{{entry.id}}</td>
                <td>{{entry.product_name}}</td>
                <td>{{entry.quantity}}</td>
                <td>{{entry.payment}}</td>
                <td>{{entry.seller_name}}</td>
                <td>{{entry.date}}</td>
                <td>{{entry.description}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Inventory/edit/';?>{{entry.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Inventory/delete/';?>{{entry.id}}" class="btn  btn-danger btn-xs">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('InventoryController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo URL_X . 'Inventory/index_json'; ?>').success(function (data) {
                $scope.entries = data;
                console.log(data);
            });

        }]);
</script>