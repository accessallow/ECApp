<?php
//expects $form_submit_url 
//expects $back_url
?>
<div ng-controller="ShoppingItemController">
    <form class="form-horizontal" data-parsley-validate role="form" 
          action="<?php echo $form_submit_url; ?>" 
          method="POST">

        <?php if (isset($edit)) { ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Shopping List</label>
            <div class="col-sm-4">
                <select name="list_id" class="form-control" required>
                    <option value="">Choose a list</option>

                    <option ng-repeat="list in lists"
                            ng-selected="select_list(list.id);"
                            value="{{list.id}}">
                        {{list.list_name}}
                    </option>

                </select>
            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-2 control-label">Product Name</label>
            <div class="col-sm-4">
                <select name="product_id" class="form-control"   
                        ng-model="product_id"
                        ng-change="refresh_sellers(product_id);"

                        required>
                    <option value="" 
                    <?php if (!isset($edit)) echo ' selected '; ?>
                            >Choose a product
                    </option>
                    <option ng-repeat="product in products"
                    <?php if (isset($edit)) { ?>
                                ng-selected="select_product(product.id);"
                            <?php } ?>
                            value="{{product.id}}">
                        {{product.product_name}}
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Seller</label>
            <div class="col-sm-4">
                <select name="seller_id" class="form-control"  
                        ng-model="seller_id"
                        ng-change="refresh_products(seller_id);"
                        required>
                    <option value="" 
                    <?php if (!isset($edit)) echo ' selected '; ?>
                            >Choose a seller</option>
                    <option ng-repeat="seller in sellers"
                    <?php if (isset($edit)) { ?>
                                ng-selected="select_seller(seller.id);"
                            <?php } ?>
                            value="{{seller.id}}">
                        {{seller.seller_name}}
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Rate</label>
            <div class="col-sm-2">


                <input type="text" 
                       value="{{rate}}" 
                       class="form-control" 
                       required 
                       name="rate" 
                       ng-model="rate"
                       placeholder=""/> 

            </div>
            <a class="btn btn-primary" ng-click="give_me_rate_from_mapping(product_id, seller_id)" >Fetch rate from mapping</a>
            <a class="btn btn-info" ng-click="give_me_rate_from_inventory(product_id, seller_id)" >Fetch rate from inventory</a>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Quantity</label>
            <div class="col-sm-4">
                <input type="text" 
                       class="form-control" 
                       required
                       <?php if (isset($edit)) { ?>
                           value="<?php echo $quantity; ?>"
                       <?php } ?>
                       name="quantity" 
                       ng-model="quantity"
                       placeholder=""/> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Total Price</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" required name="total_price" 
                       value="{{rate * quantity||0}}"
                       placeholder=""/> 
            </div>
        </div>





        <div class="form-group">
            <label class="col-sm-2 control-label"> Description </label>
            <div class="col-sm-4">
                <textarea class="form-control"  name="description">
                    <?php if (isset($edit)) { ?>
                                          <?php echo $description; ?>
                    <?php } ?>
                </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a href="<?php echo $back_url; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>
</div> <!--controller div-->
<script>
    var app = angular.module('myapp', []);
    app.controller('ShoppingItemController', ['$scope', '$http', function ($scope, $http) {

//            $scope.price = 0;
//            $scope.give_me_price = function (product_id, seller_id) {
//                $http.get('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id).success(function (data) {
//                    //return data[0].product_price;
//                    console.log('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id);
//                    console.log(data);
//                    if (data[0] != null) {
//                        //console.log("Data comes here = "+data);
//                       //  console.log("Data[0] comes here = "+data[0]);
//                        $scope.price = data[0].product_price;
//                    } else {
//
//                        $scope.price = 0;
//                    }
//                }).error(function(data){
//                    console.log("error says!!!");
//                    console.log('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id);
//                    console.log(data);
//                });
//            };
            var choosen_list_id = <?php echo $list_id; ?>;

            $scope.select_list = function (list_id) {
                if (list_id == choosen_list_id)
                    return true;
                else
                    return false;
            };

<?php if (isset($edit)) { ?>
                $scope.select_product = function (product_id) {
                    if (product_id == <?php echo $product_id; ?>)
                        return true;
                    else
                        return false;
                };
                $scope.select_seller = function (seller_id) {
                    if (seller_id == <?php echo $seller_id; ?>)
                        return true;
                    else
                        return false;
                };
                $scope.rate = <?php echo $rate; ?>;
                $scope.quantity = <?php echo $quantity; ?>;
<?php } ?>


            $http.get('<?php echo $products_fetch_url; ?>').success(function (data) {
                $scope.products = data;
            });
            $http.get('<?php echo $sellers_fetch_url; ?>').success(function (data) {
                $scope.sellers = data;
            });
            $http.get('<?php echo $shopping_lists_fetch_url; ?>').success(function (data) {
                $scope.lists = data;
            });

            $scope.refresh_sellers = function (product_id) {
                url = '<?php echo $sellers_refresh_url; ?>' + product_id;
                if (product_id == undefined) {
                    url = '<?php echo $sellers_fetch_url; ?>';
                    console.log("product_id undefined!!!");
                }
                $http.get(url).success(function (data) {
                    $scope.sellers = data;
                });
            };

            $scope.refresh_products = function (seller_id) {
                url = '<?php echo $products_refresh_url; ?>' + seller_id;
                if (seller_id == undefined) {
                    url = '<?php echo $products_fetch_url; ?>';
                    console.log("seller_id undefined!!!");
                }
                $http.get(url).success(function (data) {
                    $scope.products = data;
                });
            };

        }]);

</script>