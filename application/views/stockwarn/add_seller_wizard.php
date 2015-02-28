<div class="row well">
    
    <h3><?php echo $product_name; ?> <small>Sellers</small></h3>
    <span class="badge">Category: <?php echo $category; ?></span>
    <span class="badge">Brand: <?php echo $brand; ?></span>
    <span class="badge">Stock = <?php echo $stock; ?></span>
    
    <p style="width:400px;margin-top: 10px;">
        <input type="text" class="form-control" 
               placeholder="Search"
               ng-model="m"/>
        
    </p>
</div>
<hr/>
<div class="row" ng-controller="SellersController">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <td>Seller</td>
                <td>Price</td>
                <td>Tin number</td>
                <td>Phone</td>
                <td>Address</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="seller in sellers|filter:m">
                <td>{{seller.seller_name}}</td>
                <td>{{seller.product_price}}</td>
                <td>{{seller.tin_number}}</td>
                <td>{{seller.seller_phone_number}}</td>
                <td>{{seller.seller_address}}</td>
                <td>
                    <a href="<?php echo $forward_url; ?>{{seller.id}}"
                       class="btn btn-success btn-xs">
                        Add to shopping list
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('SellersController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_url;?>').success(function (data) {
                $scope.sellers = data;
                console.log(data);
            });

        }]);
        
</script>