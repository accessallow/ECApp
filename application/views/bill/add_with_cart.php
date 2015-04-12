<?php
$add_link = "#";
$addButtonLabel = "Add new bill";
?>
<div class="row  noprint">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input placeholder="Search..." class="form-control noprint" type="text" ng-model="m"/>
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
<div class="row">
    <div class="col-md-3" ng-controller="ProductController">
        <ul class="list-group" id="product_list">

            <li 
                class="list-group-item" 
                ng-repeat="product in products|filter:m" 
                data-product-id="{{product.id}}" 
                data-product-name="{{product.product_name}}">

                <span class="badge">{{product.stock}}</span>
                <button class="btn btn-primary btn-xs">+</button>
                &nbsp {{product.product_name}}

            </li>

        </ul>
    </div>
    <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Basket
                <button class="btn btn-danger btn-xs pull-right" id="clear_cart1">Clear</button>
                <button class="btn btn-success btn-xs pull-right" id="finalize_cart1">Finalize</button>

            </div>
            <div class="panel-body">
                <ul class="list-group" id="mycart1">

                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">

    </div>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $product_fetch_url; ?>').success(function (data) {
                $scope.products = data;
                console.log(data);
            });

        }]);
</script>
<script>
    $(document).ready(function () {
        $("#mycart1").load("<?php echo $reload_cart1_url; ?>", function () {

        });

        $("#product_list").delegate("li", "click", function () {
            var elem = $(this);
            //elem.css("background-color", "pink");
            //$("li").css("background-color", "pink");
            //alert(elem.data("productName"));
            var url = "<?php echo $list1_append_url; ?>/" + elem.data("productId");
            console.log(url);
            $.ajax({url: url, success: function (result) {
                    //$("#div1").html(result);
                    //alert("sent");
                    $("#mycart1").empty();
                    $("#mycart1").load("<?php echo $reload_cart1_url; ?>", function () {

                    });
                }});
        });
        $("#clear_cart1").click(function () {
            var cart_reset_url = '<?php echo $cart_reset_url; ?>';
            $.ajax({url: cart_reset_url, success: function (result) {
                    //$("#div1").html(result);
                    //alert("sent");
                    $("#mycart1").empty();
                    $("#mycart1").load("<?php echo $reload_cart1_url; ?>", function () {

                    });
                }});
        });
        $("#finalize_cart1").click(function () {
            var cart_elements = $("#mycart1").children();
            $.each(cart_elements, function (index, value) {
                var v = cart_elements[index];
                console.log(typeof v);
                //console.log(v);
            });
        });
    });
</script>