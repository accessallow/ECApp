

<div class="row">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" ng-model="s"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
          <a class="btn btn-success btn-xs" href="<?php echo URL_X.'Seller/add_new';?>">Add new Seller</a>
    </div>
</div>


<br/>
<div ng-controller="SellerController">
<table class="table table-hover table-striped">

    <tr ng-repeat="seller in sellers|filter:s">
<td>{{seller.seller_name}}</td>
<td>{{seller.seller_phone_number}}</td>
<td>{{seller.seller_address}}</td>
    <td>
        <a href="<?php echo URL_X.'Seller/edit/';?>{{seller.id}}" class="btn  btn-primary btn-xs">Edit</a>
        <a href="<?php echo URL_X.'Seller/delete/';?>{{seller.id}}" class="btn  btn-danger btn-xs">Delete</a>
    </td>
    </tr>
    
    

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