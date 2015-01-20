<!--DONE-->
<?php
//$assoc_array = NULL;
//foreach ($categories as $c) {
//    $assoc_array[$c->id] = $c->product_category_name;
//}
?>

<?php
$url = "";
$label = "All inventories";
$get_all = URL_X . 'Inventory/';
$get_all_link = "<a class=\"badge\" href=\"$get_all\">Get all</a>";
$should_set_link = NULL;

if (isset($product_id)) {
    $url = URL_X . 'Inventory/index_json?product_id=' . $product_id;
    $label = "Inventories for Product : " . $product_name;
    $should_set_link = 1;
} elseif (isset($seller_id)) {
    $url = URL_X . 'Inventory/index_json?seller_id=' . $seller_id;
    $label = "Inventories for Seller : " . $seller_name;
    $should_set_link = 1;
} else {
    $url = URL_X . 'Inventory/index_json';
    $should_set_link = 0;
}
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
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Inventory/add_new'; ?>">Add new Inventory Entry</a>
    </div>
</div>
<br/>

<div ng-controller="InventoryController">
    <div class="row well">
        <h4>{{label}} 
            <?php
            if ($should_set_link == 1) {
                echo $get_all_link;
            }
            ?>
        </h4>
        <p>
            <span class="badge">Total entries : {{entries.length}}</span>
            <span class="badge">Total payment : Rs. <?php echo $sum;?>/-</span>
        </p>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr style="font-weight: bolder;">
                <td>Id</td>
                <td>Product</td>
                <td>Quantity</td>
                <td>Payment</td>
                <td>Seller</td>
                <td>Date</td>
                <td>Description</td>
                <td>Action</td>
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
                <td>{{entry.quantity}}</td>
                <td>{{entry.payment}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Inventory?seller_id='; ?>{{entry.seller_id}}">
                        {{entry.seller_name}}
                    </a>
                </td>
                <td>{{entry.date}}</td>
                <td>{{entry.description}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Inventory/edit/'; ?>{{entry.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Inventory/delete/'; ?>{{entry.id}}" class="btn  btn-danger btn-xs">Delete</a>
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
            });

        }]);
</script>