<?php
$url = URL_X . 'ShoppingList/get_all_lists';
$list_items_url = URL_X . 'ShoppingList/get_items_of_list';

$item_add_link = URL_X . 'ShoppingList/add_item';
$item_edit_link = URL_X . 'ShoppingList/edit_item';
$item_delete_link = URL_X . 'ShoppingList/delete_item';

$list_edit_link = URL_X . 'ShoppingList/edit_shopping_list';
$list_delete_link = URL_X . 'ShoppingList/delete_shopping_list';
$add_new_list_link = URL_X . 'ShoppingList/add_new_shopping_list';
?>
<div class="row" >
    <div class="col-md-7">

    </div>
    <div class="col-md-5"
         style="text-align: right;margin-bottom: 10px;">
        <a 
            href="<?php echo $add_new_list_link; ?>"
            class="btn btn-success btn-xs">
            Add new shopping list
        </a>
    </div>



</div>
<div class="row" ng-controller="ShoppingController">


    <div class="col-md-4">

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>List name</td>
                    <td style="text-align: right;">Action</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="list in lists">
                    <td> 
                        <a href="#" 
                           ng-click="loadList(list.id);">
                            {{list.list_name}}
                        </a>
                    </td>
                    <td style="text-align: right;">
                        <a class="btn btn-xs btn-info" 
                           href="<?php echo $item_add_link ?>/{{list.id}}">
                            +
                        </a>
                        <a class="btn btn-xs btn-primary" 
                           href="<?php echo $list_edit_link ?>/{{list.id}}">
                            Edit
                        </a>
                        <a class="btn btn-xs btn-danger" 
                           href="<?php echo $list_delete_link ?>/{{list.id}}">
                            Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>



    </div>
    <div class="col-md-8">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>id</td>
                    <td>Product</td>
                    <td>Seller</td>
                    <td>Rate</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in items">
                    <td>{{item.id}}</td>
                    <td>{{item.product_name}}</td>
                    <td>{{item.seller_name}}</td>
                    <td>{{item.rate}}</td>
                    <td>{{item.quantity}}</td>
                    <td>{{item.total_price}}</td>
                    <td>{{item.description}}</td>
                    <td>
                        <a class="btn btn-xs btn-primary" 
                           href="<?php echo $item_edit_link ?>/{{item.id}}">
                            Edit
                        </a>
                        <a class="btn btn-xs btn-danger" 
                           href="<?php echo $item_delete_link ?>/{{item.id}}">
                            Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('ShoppingController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $url ?>').success(function (data) {
                $scope.lists = data;
                console.log(data);
                $scope.loadList = function (list_id) {
                    console.log(list_id);
                    url = '<?php echo $list_items_url; ?>/' + list_id;
                    console.log("Items fetching from = " + url);
                    $http.get(url).success(function (data) {
                        $scope.items = data;
                        
                    });
                }

            });


        }]);


</script>