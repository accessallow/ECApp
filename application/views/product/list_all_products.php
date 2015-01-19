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
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Product/add_new'; ?>">Add new Product</a>
    </div>
</div>
<br/>

<div ng-controller="ProductController">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td>Product</td>
                <td>Brand</td>
                <td>Category</td>
                <td>Description</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="product in products|filter:m">
                <td>
                    <a href="<?php echo URL_X . 'Product_seller_mapping/sellers/'; ?>{{product.id}}">
                        {{product.product_name}}
                    </a>
                </td>
                <td> {{product.product_brand}}</td>
                <?php // $product_category = $this->product_category_model->get_category_name($s->product_category);  ?>
                <td> {{product.product_category}}</td>
                <td> {{product.product_description}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Product/edit/'; ?>{{product.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Product/delete/'; ?>{{product.id}}" class="btn  btn-danger btn-xs">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo URL_X . 'Product/index_json'; ?>').success(function (data) {
                $scope.products = data;
                console.log(data);
            });
//                    $http.get('<?php echo URL_X . 'Product_category/index_json'; ?>').success(function(data){
//                      //  $scope.categories = data;
//                      var categoryAssociatedArray={};
//                       data.forEach(function(val){
//                           categoryAssociatedArray[val['id']]=val['product_category_name'];
//                       });
//                        console.log(categoryAssociatedArray);
//                        $scope.categories = categoryAssociatedArray;
//                    });
        }]);
</script>