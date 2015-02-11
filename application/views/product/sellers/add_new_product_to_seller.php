<!--DONE-->
<?php
$category_array = NULL;
foreach ($categories as $c) {
    $category_array[$c->id] = $c->product_category_name;
}
$product = $product[0];
?>
<div class="row well">
    <h4>
        Attaching a seller to : <?php echo $product->product_name; ?>  
    </h4>
    <a href="#" class="badge">
        Category : <?php echo $category_array[$product->product_category]; ?>
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <table class="table table-striped table-hover" ng-controller="NonSellersController">
            <thead>
                <tr>
                    <td>Sellers who dont sell <?php echo $product->product_name; ?></td>

                </tr>
            </thead>
            <tbody>

                <tr ng-repeat="seller in non_sellers">
                    <td>{{seller.seller_name}}</td>

                </tr>

            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo URL_X . 'Product_seller_mapping/add_new_seller_to_a_product/' . $product->id; ?>" method="POST">
            <input type="hidden"  name="product_id" value="<?php echo $product->id ?>"/>
            <div class="form-group">
                <label for="seller_id" class="col-sm-2 control-label">Seller</label>
                <div class="col-sm-8">

                    <select ng-controller="NonSellersController" name="seller_id" class="form-control" required>
                        <option value="" selected>Choose a seller</option>

                        <option ng-repeat="seller in non_sellers"
                                value="{{seller.id}}">
                                    {{seller.seller_name}}
                        </option>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="product_price" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" required name="product_price" placeholder=""/> 
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-success" value="Save"/>
                    <input type="reset" class="btn" value="Clear"/>
                   
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-4">
        <table  ng-controller="SellersController" class="table table-striped table-hover">
            <thead>
                <tr>
                    <td colspan="3" class="well" style="color:black;">
                        Sellers who sell <?php echo $product->product_name;?>
                    </td>
                </tr>
                <tr>
                    <td>Seller</td>
                    <td>Price</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>

                <tr ng-repeat="seller in sellers">
                    <td>{{seller.seller_name}}</td>
                    <td>{{seller.product_price}}/-</td>
                    <td>
                        <a href="<?php echo URL_X.'Product_seller_mapping/delete_a_mapping/';?>{{seller.mapping_id}}" class="btn btn-danger btn-xs">
                            Delete
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div> <!--row-->

<script>
    var app = angular.module('myapp', []);
    app.controller('NonSellersController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $fetch_non_sellers_json_link; ?>').success(function (data) {
                $scope.non_sellers = data;
                console.log(data);
            });

        }]);
    app.controller('SellersController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $fetch_sellers_json_link; ?>').success(function (data) {
                $scope.sellers = data;
                console.log(data);
            });

        }]);
</script>