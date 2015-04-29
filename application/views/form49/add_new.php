<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>


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
                    <input 
                        type="text" 
                        autofocus
                        class="form-control" 
                        required name="shop_name" 
                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->shop_name; ?>"
                        <?php } ?>
                        <?php if (isset($seller)) { ?>
                            value ="<?php echo $seller_data->seller_name; ?>"
                        <?php } ?>
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                    <textarea 
                        class="form-control" 
                        required 
                        name="address"><?php if (isset($edit)) { ?><?php echo $form->address; ?><?php } elseif (isset($seller)) { ?><?php echo trim($seller_data->seller_address, ''); ?><?php } ?></textarea> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">TIN number</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 
                        required 
                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->tin_number; ?>"
                        <?php } ?>
                        <?php if (isset($seller)) { ?>
                            value ="<?php echo $seller_data->tin_number; ?>"
                        <?php } ?>
                        name="tin_number" 
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Invoice number</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 
                        autofocus="autofocus"

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->invoice_number; ?>"
                        <?php } ?>
                        name="invoice_number" 
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Form number</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 
                        autofocus="autofocus"

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->form_number; ?>"
                        <?php } ?>
                        name="form_number" 
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Form Date</label>

                <div class="col-sm-8">
                    <div class='input-group date' id='datetimepicker1'>

                        <input type="text" 

                               data-date-format="YYYY-MM-DD" 
                               class="form-control" 
                               <?php if (isset($edit)) { ?>
                                   value ="<?php echo $form->form_date; ?>"
                               <?php } else { ?>
                                   value="<?php echo $set_date; ?>"
                               <?php } ?>
                               name="form_date" 
                               placeholder=""/> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Total value</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->total_value; ?>"
                        <?php } ?>
                        name="total_value"
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Total quantity</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->total_quantity; ?>"
                        <?php } ?>
                        name="total_quantity" 
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Dispatch location</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->dispatch_location; ?>"
                        <?php } ?>
                        name="dispatch_location"
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Destination</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->destination; ?>"
                        <?php } ?>
                        name="destination" 
                        placeholder=""/> 
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <!--            <div class="form-group">
                            <label class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                                <select name="product" class="form-control"   required>
                                    <option 
                                        value="" 
            <?php if (!isset($edit)) { ?>
                                                selected
            <?php } else { ?>
                
            <?php } ?>
                                        >Choose a product</option>
            
                                    <option 
                                        ng-repeat="product in products" 
                                        ng-selected="check_selected_product(product.id)"
                                        value="{{product.id}}">
            
                                        {{product.product_name}} - {{product.product_brand}}
            
                                    </option>
            
                                </select>
                            </div>
                        </div>-->

            <div class="form-group">
                <label class="col-sm-4 control-label">Product %</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->product_percent; ?>"
                        <?php } ?>
                        name="product_percent"
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">CST %</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->cst_percent; ?>"
                        <?php } ?>
                        name="cst_percent"
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Category</label>
                <div class="col-sm-8">
                    <select name="category" required>
                        <option 
                            value="" 

                            <?php if (!isset($edit)) { ?>
                                selected
                            <?php } else { ?>

                            <?php } ?>
                            >Choose a category</option>

                        <option 
                            ng-repeat="category in categories"
                            ng-selected="check_selected_category(category.id)"
                            value="{{category.id}}">

                            {{category.product_category_name}}

                        </option>

                    </select>
                </div>
            </div>
            <!--            <div class="form-group">
                            <label class="col-sm-4 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea 
                                    class="form-control" 
                                    required 
                                    name="description">
            <?php if (isset($edit)) { ?>
                <?php echo $form->description; ?>
            <?php } ?>
                                </textarea> 
                            </div>
                        </div>-->
            <div class="form-group">
                <label class="col-sm-4 control-label">Transport value</label>
                <div class="col-sm-8">
                    <input 
                        type="text"
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->transport_value; ?>"
                        <?php } ?>
                        name="transport_value"
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Billty number</label>
                <div class="col-sm-8">
                    <input 
                        type="text" 
                        class="form-control" 

                        <?php if (isset($edit)) { ?>
                            value ="<?php echo $form->billty_number; ?>"
                        <?php } ?>
                        name="billty_number" 
                        placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Vehicle number</label>
                <div class="col-sm-8">
                    <input type="text"
                           class="form-control" 

                           <?php if (isset($edit)) { ?>
                               value ="<?php echo $form->vehicle_number; ?>"
                           <?php } ?>
                           name="vehicle_number"
                           placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Form "C"</label>
                <div class="col-sm-8">
                    <input type="text" 
                           class="form-control" 

                           <?php if (isset($edit)) { ?>
                               value ="<?php echo $form->form_c; ?>"
                           <?php } ?>
                           name="form_c"
                           placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Date</label>

                <div class="col-sm-8">
                    <div class='input-group date' id='datetimepicker1'>

                        <input type="text" 

                               data-date-format="YYYY-MM-DD" 
                               class="form-control" 
                               <?php if (isset($edit)) { ?>
                                   value ="<?php echo $form->date; ?>"
                               <?php } else { ?>
                                   value="<?php echo $set_date; ?>"
                               <?php } ?>
                               name="date" 
                               placeholder=""/> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

            </div>
            <div class="pull-right">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn btn-default" value="Clear"/>
                <a accesskey="c" href="<?php echo $back_url; ?>" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('AddFormController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $categories_fetch_link; ?>').success(function (data) {
                $scope.categories = data;
                console.log("Categories:\n" + data);
            });
            $http.get('<?php echo $products_fetch_link; ?>').success(function (data) {
                $scope.products = data;
                console.log("Products:\n" + data);
            });
<?php if (isset($edit)) { ?>
    //                $scope.check_selected_product = function (product_id) {
    //                    form_product_id = <?php //echo $form->product;  ?>;
    //                    if (product_id == form_product_id) {
    //                        return true;
    //                    } else {
    //                        return false;
    //                    }
    //                }
                $scope.check_selected_category = function (category_id) {
                    form_category_id = <?php echo $form->category; ?>;
                    if (category_id == form_category_id) {
                        return true;
                    } else {
                        return false;
                    }
                }
<?php } ?>

        }]);
</script>
