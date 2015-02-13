<?php
$categories_fetch_link = site_url('Product_category/index_json');
$products_fetch_link = site_url('Product/index_json');
?>
<div class="row" ng-controller="AddFormController">
    <form action="<?php echo $form_submit_url; ?>" method="post" class="form-horizontal" role="form" data-parsley-validate>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">Shop name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="shop_name" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                    <textarea class="form-control" 
                              required name="address"></textarea> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">TIN number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="tin_number" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Invoice number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="invoice_number" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Total value</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="total_value" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Total quantity</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="total_quantity" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Dispatch location</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="dispatch_location" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Destination</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="destination" placeholder=""/> 
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-8">
                    <select name="product" ng-model="product_id"  class="form-control"   required>
                        <option value="" selected>Choose a product</option>

                       <option ng-repeat="product in products" value="{{product.id}}">

                           {{product.product_name}} - {{product.product_brand}}

                        </option>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Category</label>
                <div class="col-sm-8">
                    <select name="category" ng-model="product_id"  class="form-control"   required>
                        <option value="" selected>Choose a category</option>

                        <option ng-repeat="category in categories" value="{{category.id}}">

                           {{category.product_category_name}}

                        </option>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Description</label>
                <div class="col-sm-8">
                    <textarea class="form-control" 
                              required name="description"></textarea> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Transport value</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="transport_value" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Billty number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="billty_number" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Vehicle number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="vehicle_number" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Form "C"</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" 
                           required name="form_c" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Date</label>

                <div class="col-sm-8">
                    <div class='input-group date' id='datetimepicker1'>

                        <input type="text" required data-date-format="YYYY-MM-DD" class="form-control" name="date" placeholder=""/> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

            </div>
            <div class="pull-right">
                <input type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn btn-default" value="Clear"/>
                <a href="<?php echo $back_url; ?>" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('AddFormController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $categories_fetch_link; ?>').success(function (data) {
                $scope.categories = data;
                console.log("Categories:\n"+data);
            });
            $http.get('<?php echo $products_fetch_link; ?>').success(function (data) {
                $scope.products = data;
                console.log("Products:\n"+data);
            });

        }]);
</script>
