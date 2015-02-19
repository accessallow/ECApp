<?php
$my_seller_link = site_url('Product/get_sellers_for_this_product?product_id=');
?>
<div class="row well">
    <h4>Products whose stock is zero <span class="badge">34</span></h4>
</div>
<div class="row" ng-controller="StockProductController">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td>Product</td>
                <td>Brand</td>
                <td>Category</td>


                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="product in products">
                <td>{{product.product_name}}</td>
                <td>{{product.product_brand}}</td>
                <td>{{my_category_name(product.product_category)}}</td>

                <td>
                    <a href="#" class="btn btn-success btn-xs">
                        Add to shopping list
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('StockProductController', ['$scope', '$http', function ($scope, $http) {

            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.products = data;
                console.log(data);
            });

            $http.get('<?php echo site_url('Product_category/index_json'); ?>').success(function (data) {
                $scope.categories = data;
                console.log(data);
            });

            $scope.my_category_name = function (category_id) {
                for(i=0;i<$scope.categories.length;i++){
                    if($scope.categories[i].id == category_id){
                        return $scope.categories[i].product_category_name;
                    }
                }
            }
            

        }]);
</script>