<?php
$url = URL_X . 'ShoppingList/get_all_lists';
$list_items_url = URL_X . 'ShoppingList/get_items_of_list';

$item_add_link = URL_X . 'ShoppingList/add_item_to_shopping_list';
$item_edit_link = URL_X . 'ShoppingList/edit_item_of_shopping_list';
$item_delete_link = URL_X . 'ShoppingList/delete_item_from_shopping_list';

$list_edit_link = URL_X . 'ShoppingList/edit_shopping_list';
$list_delete_link = URL_X . 'ShoppingList/delete_shopping_list';
$add_new_list_link = URL_X . 'ShoppingList/add_new_shopping_list';
$seller_fetch_url = site_url('Seller/get_one_seller_json');
?>
<div class="row noprint well" >
    <div class="col-md-7 ">
        <h4>Shopping List dashboard</h4>
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


    <div class="col-md-4 noprint">

        <table class="table table-striped noprint">
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
                           ng-click="loadList(list.id, list.list_name);">
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
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6" style="text-align: right;">
                <p>{{address}}</p>
                <p>{{phone}}</p>
            </div>

        </div>
        <table class="table table-striped" style="font-size: 0.9em;">
            <thead>
                <tr>
                    <td colspan="10">
                        {{ListName}}
                    </td>
                </tr>
                <tr>
                    <td  class="noprint">id</td>
                    <td>Product</td>
                    <td>Brand</td>
                    <td class="">Seller</td>
                    
                    <td>Quantity</td>
                    
                    <td class="noprint">Description</td>
                    <td class="">Rate</td>
                    <td class="">Total</td>
                    <td class="noprint">Action</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in items">
                    <td  class="noprint">{{item.id}}</td>
                    <td>{{item.product_name}}</td>
                    <td>{{item.product_brand}}</td>
                  
                    <td  class="">
                        <a href="#" 
                           ng-click="refreshList(list_id, ListName + ' : ' + item.seller_name, item.seller_id);">
                            {{item.seller_name}}
                        </a>
                    </td>
                    
                    <td>{{item.quantity}}</td>
                    
                    <td  class="noprint">{{item.description}}</td>
                    <td  class="">{{item.rate}}</td>
                    <td  class="">{{item.total_price}}</td>
                    <td class="noprint">
                        <a class="btn btn-xs btn-primary" 
                           href="<?php echo $item_edit_link ?>/{{item.list_id}}/{{item.id}}">
                            Edit
                        </a>
                        <a class="btn btn-xs btn-danger" 
                           href="<?php echo $item_delete_link ?>/{{item.list_id}}/{{item.id}}">
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
                $scope.address = "";
                $scope.phone = "";




                $scope.ListName = "Please select a list";
                $scope.loadList = function (list_id, list_name) {
                    console.log(list_id);
                    url = '<?php echo $list_items_url; ?>/' + list_id;
                    console.log("Items fetching from = " + url);
                    $http.get(url).success(function (data) {
                        $scope.items = data;
                        $scope.ListName = list_name;
                        $scope.list_id = list_id;
                    });
                }

                $scope.refreshList = function (list_id, list_name, seller_id) {
                    console.log(list_id);
                    url = '<?php echo $list_items_url; ?>/' + list_id + '/' + seller_id;
                    console.log("Items fetching from = " + url);
                    $http.get(url).success(function (data) {
                        $scope.items = data;
                        $scope.ListName = list_name;
                        $scope.list_id = list_id;
                    });
                    sellerUrl = '<?php echo $seller_fetch_url; ?>/' + seller_id;
                    $http.get(sellerUrl).success(function (data) {
                        $scope.seller = data;
                    });
                    //console.log("seller_url = " + sellerUrl);

                    //get_fucking_address(seller_id);
                }


            });


        }]);


</script>