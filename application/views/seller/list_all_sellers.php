

<div class="row">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" ng-model="s"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Seller/add_new'; ?>">Add new Seller</a>
    </div>
</div>

<div class="row well">
    <h4>All sellers</h4>
    <p>
        <span class="badge">Total sellers : <?php echo $total_sellers_alive;?></span>
    </p>
</div>

<div ng-controller="SellerController">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td>Seller</td>
                <td>Phone</td>
                <td>Address</td>
                <td>Actions</td>
            </tr>
        </thead>

        <tbody>
            <tr ng-repeat="seller in sellers|filter:s">
                <td>
                    <a href="<?php echo URL_X;?>/Inventory?seller_id={{seller.id}}">
                    {{seller.seller_name}}
                    </a>
                </td>
                <td>{{seller.seller_phone_number}}</td>
                <td>{{seller.seller_address}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Seller/edit/'; ?>{{seller.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Seller/delete/'; ?>{{seller.id}}" class="btn  btn-danger btn-xs">Delete</a>
                </td>
            </tr>
        </tbody>


    </table>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('SellerController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo URL_X . 'Seller/index_json'; ?>').success(function (data) {
                $scope.sellers = data;
                console.log(data);
            });
        }]);
</script>