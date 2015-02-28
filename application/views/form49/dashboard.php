<!--DONE-->
<?php
//$assoc_array = NULL;
//foreach ($categories as $c) {
//    $assoc_array[$c->id] = $c->product_category_name;
//}
$single_url = site_url('Form49/get');
$edit_url = site_url('Form49/edit');
$delete_url = site_url('Form49/delete');
$view_url = site_url('Form49/get');
?>

<div class="row  noprint">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control noprint" type="text" ng-model="m"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs noprint" 
           href="<?php echo $add_link; ?>">
               <?php echo $addButtonLabel; ?>
        </a>
    </div>
</div>
<div class="row well noprint">
    <h4><?php echo $label; ?>
        <?php
        if (isset($get_all_link)) {
            echo $get_all_link;
        }
        ?>
    </h4>
    <p>
        <span class="badge">Total products: <?php echo $total_products; ?></span>
        <?php if (isset($total_products_under_this_category)) { ?>
            <span class="badge">Total products under <?php echo $category_name; ?> : <?php echo $total_products_under_this_category; ?></span>
        <?php } ?>
        <span class="badge">Total uncategorized products: <?php echo $total_uncategorized_products; ?></span>
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
        <h4><?php echo $label; ?></h4>
        Total products: <?php echo $total_products; ?>
        <br/>
        <?php if (isset($total_products_under_this_category)) { ?>
            Total products under <?php echo $category_name; ?> : <?php echo $total_products_under_this_category; ?>
            <br/>
        <?php } ?>

        Total uncategorized products: <?php echo $total_uncategorized_products; ?>
    </div>

</div>



<div ng-controller="Form49Controller" style="width: 119%;margin-left:-80px;font-size: 0.8em;">



    <table class="table table-hover table-striped table-condensed table-bordered">
        <thead>
            <tr>
                <td>Shop name</td>
                <td>Address</td>
                <td>TIN no.</td>
                <td>Invoice no.</td>
                <td>Date</td>
                <td>Total value</td>
                <td>Total quantity</td>
                <td>Dispatch location</td>
                <td>Destination</td>
                <td>Category</td>
                <td>Product</td>
                <td>Description</td>
                <td>Transport value</td>
                <td>Billty no.</td>
                <td>Vehicle no.</td>
                <td>Form "C"</td>

                <td class="noprint">Action</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="form in forms|filter:m">
                <td>{{form.shop_name}} </td>
                <td>{{form.tin_number}}</td>
                <td>{{form.address}}</td>
                <td>{{form.invoice_number}}</td>
                <td>{{form.date}}</td>
                <td>{{form.total_value}}</td>
                <td>{{form.total_quantity}}</td>
                <td>{{form.dispatch_location}}</td>
                <td>{{form.destination}}</td>
                <td>{{form.category}}</td>
                <td>{{form.product}}</td>
                <td>{{form.description}}</td>
                <td>{{form.transport_value}}</td>
                <td>{{form.billty_number}}</td>
                <td>{{form.vehicle_number}}</td>
                <td>{{form.form_c}}</td>


               
                
                <td class="noprint">
                        <a href="<?php echo $view_url; ?>/{{form.id}}" class="btn  btn-info btn-xs">V</a>
                        <a href="<?php echo $edit_url; ?>/{{form.id}}" class="btn  btn-primary btn-xs">E</a>
                        <a href="<?php echo $delete_url; ?>/{{form.id}}" class="btn  btn-danger btn-xs">D</a>
                   
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('Form49Controller', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.forms = data;
                console.log(data);
            });

        }]);
</script>