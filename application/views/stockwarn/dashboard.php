<?php
$my_seller_link = site_url('Product/get_sellers_for_this_product?product_id=');
?>
<div class="row noprint">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input  placeholder="Search..." class="form-control" type="text" ng-model="m"/>
            </div>
        </form>
    </div>
    
</div>
<div class="row well">
    <h4>Products whose stock is zero <span class="badge"><?php echo $total_stockzero_products; ?></span></h4>
</div>
<div class="row" ng-controller="StockProductController">
    <table class="table table-hover">
        <thead>
            <tr>
                <td>Product</td>
                <td>Brand</td>
                <td>Category</td>
                <td>#Appearance</td>

                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="product in products|filter:m"
                ng-class="{success: is_not_zero(product.item_count),danger:is_marked_down(product.mark)}"
                >
                <td>{{product.product_name}}</td>
                <td>{{product.product_brand}}</td>
                <td>{{my_category_name(product.product_category)}}</td>
                <td>{{product.item_count}}</td>
                <td>
                    <a href="<?php echo site_url('StockWarning/add_seller_wizard');?>/{{product.id}}" 
                       class="btn btn-success btn-xs">
                        Add to shopping list
                    </a>
                    <a href="<?php echo site_url('StockWarning/mark_down');?>/{{product.id}}" 
                       class="btn btn-danger btn-xs">
                        Mark
                    </a>
                    <a href="<?php echo site_url('StockWarning/mark_up');?>/{{product.id}}" 
                       class="btn btn-info btn-xs">
                        Unmark
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
                
                $scope.my_category_name = function (category_id) {
                for(i=0;i<$scope.categories.length;i++){
                    if($scope.categories[i].id == category_id){
                        return $scope.categories[i].product_category_name;
                    }
                }
            }
                
            });

            
            $scope.is_not_zero = function (count){
                if(count>0) return true;
                else return false;
            }
            $scope.is_marked_down = function (mark){
                if(mark==1) return true;
                else return false;
            }
            

        }]);
</script>