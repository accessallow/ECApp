<html ng-app="myapp">
    <head>
        <script src="<?php echo URL; ?>assets/angularjs/angular.min.js"></script>
    </head>
    <body>
        <div>
            <input type="text" ng-model="m"/>
        </div>
        <div class="main" ng-controller="ProductController">
            <ul>
                <li ng-repeat="product in products|filter:m">
                    id = {{product.id}}<br/>
                    product_name = {{product.product_name}}<br/>
                    product_brand = {{product.product_brand}}<br/>
                    product_category = {{product.product_category}}<br/>
                    product_description = {{product.product_description}}<br/>
                    <hr/>
                </li>
            </ul>
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
    </body>
</html>