<!--DONE-->
<?php
//$assoc_array = NULL;
//foreach ($categories as $c) {
//    $assoc_array[$c->id] = $c->product_category_name;
//}
?>

<?php
//$url = "";
//$label = "All inventories";
$get_all = URL_X . 'Inventory/';
$get_all_link = "<a class=\"badge\" href=\"$get_all\">Get all</a>";
//$should_set_link = NULL;
/*
if (isset($product_id) && isset($seller_id) && isset($date)) {
    $url = URL_X . 'Inventory/index_json?product_id=' . $product_id."&seller_id=".$seller_id."&date=".$date;
    $label = "Inventories for Product : " . $product_name. " for seller: $seller_name for Date : $date";
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new?product_id=' . $product_id);
    $add_new_label = "Attach an inventory to this product";
} elseif (isset($product_id) && isset($seller_id)) {
    $url = URL_X . 'Inventory/index_json?product_id=' . $product_id."&seller_id=".$seller_id;
    $label = "Inventories for Product :  $product_name by Seller : $seller_name";
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new?product_id=' . $product_id);
    $add_new_label = "Attach an inventory to this product";
}elseif (isset($product_id) && isset($date)) {
    $url = URL_X . 'Inventory/index_json?product_id=' . $product_id."&date=".$date;
    $label = "Inventories for Product : $product_name on Date : $date";
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new?product_id=' . $product_id);
    $add_new_label = "Attach an inventory to this product";
}elseif (isset($seller_id) && isset($date)) {
    $url = URL_X . 'Inventory/index_json?seller_id=' . $seller_id."&date=".$date;
    $label = "Inventories for Seller : $seller_name on Date: $date";
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new?product_id=' . $product_id);
    $add_new_label = "Attach an inventory to this product";
}elseif (isset($product_id)) {
    $url = URL_X . 'Inventory/index_json?product_id=' . $product_id;
    $label = "Inventories for Product : " . $product_name;
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new?product_id=' . $product_id);
    $add_new_label = "Attach an inventory to this product";
} elseif (isset($seller_id)) {
    $url = URL_X . 'Inventory/index_json?seller_id=' . $seller_id;
    $label = "Inventories for Seller : " . $seller_name;
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new?seller_id=' . $seller_id);
    $add_new_label = "Attach an inventory to this seller";
} elseif (isset($date)) {
    $url = URL_X . 'Inventory/index_json?date=' . $date;
    $label = "Inventories for date : " . $date;
    $should_set_link = 1;
    $add_new_link = site_url('Inventory/add_new');
    $add_new_label = "Add new inventory";
} else {
    $url = URL_X . 'Inventory/index_json';
    $should_set_link = 0;
    $add_new_link = site_url('Inventory/add_new');
    $add_new_label = "Add new inventory";
}
*/
?>

<div class="row noprint">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input  placeholder="Search..." class="form-control" type="text" ng-model="m"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" 
           href="<?php echo $add_new_link; ?>"
           >
               <?php echo $add_new_label; ?>
        </a>
    </div>
</div>
<br/>

<div ng-controller="InventoryController">
    <div class="row well noprint">
        <h4>{{label}} 
            <?php
            if ($should_set_link == 1) {
                echo $get_all_link;
            }
            ?>
        </h4>
        <p>
            <span class="badge">Total entries : {{entries.length}}</span>
            <span class="badge">Total payment : Rs {{  getTotal()}}/-</span>
        </p>
    </div>
    <div class="row printonly">
        <div class="col-sm-6" style="text-align: right;">
            <?php echo SHOP_NAME; ?>
            <br/>
            <?php echo SHOP_ADDR; ?>
            <br/>
            <?php echo PHONE; ?>
        </div>
        <div class="col-sm-6">
            <h4>{{label}} </h4>
            Total entries : {{entries.length}}<br/>
            Total payment : Rs  {{  getTotal()}} /-
        </div>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr style="font-weight: bolder;">
                <td>Id</td>
                <td>Product</td>
                <td>Brand</td>
                <td>Seller</td>
                <td>Rate</td>
                <td>Quantity</td>
                <td>Payment</td>
                <td>Date</td>
                <td>Description</td>
                <td class="noprint">Action</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="entry in entries|filter:m">
                <td>{{entry.id}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Inventory?product_id='; ?>{{entry.product_id}}">
                        {{entry.product_name}}
                    </a>
                </td>
                <td>{{entry.product_brand}}</td>
                <td>
                    <a href="<?php echo $seller_url; ?>{{entry.seller_id}}">
                        {{entry.seller_name}}
                    </a>
                </td>
                <td>{{entry.rate}}</td>
                <td>{{entry.quantity}}</td>
                <td>{{entry.payment}}</td>

                <td>
                    <a href="<?php echo $date_url; ?>{{entry.date}}">
                        {{entry.date}}
                    </a>
                </td>
                <td>{{entry.description}}</td>
                <td class="noprint">
                    <a href="<?php echo URL_X . 'Inventory/single_inventory/'; ?>{{entry.id}}" class="btn  btn-info btn-xs">V</a>
                    <a href="<?php echo URL_X . 'Inventory/edit/'; ?>{{entry.id}}" class="btn  btn-primary btn-xs">E</a>
                    <a href="<?php echo URL_X . 'Inventory/delete/'; ?>{{entry.id}}" class="btn  btn-danger btn-xs">D</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>

    var app = angular.module('myapp', []);
    app.controller('InventoryController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $url ?>').success(function (data) {
                $scope.entries = data;
                console.log(data);
                $scope.label = "<?php echo $label; ?>";
                // $scope.get_all_link = "<?php echo $get_all_link; ?>";

                $scope.getTotal = function () {
                    var total = 0;
                    for (var i = 0; i < $scope.entries.length; i++) {
                        var e = $scope.entries[i];
                        total += parseInt(e.payment);
                    }
                    return total;
                }


            });



        }]);
</script>