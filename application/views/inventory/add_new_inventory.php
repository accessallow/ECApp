<?php if($this->session->userdata('message')){?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong><?php echo $this->session->flashdata('message');?></strong>
</div>
<?php } ?>


<h3>Add new inventory</h3>
<hr/>

<div ng-controller="RateController">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Inventory/add_new'; ?>" method="POST">
        <div class="form-group">
            <label class="col-sm-2 control-label">Product Name</label>
            <div class="col-sm-4">
                <select name="product_id" 
                        ng-model="product_id"  
                        class="form-control"   
                        required>
                    <option value="" <?php
                    if (!isset($product_id)) {
                        echo " selected ";
                    }
                    ?>
                            >Choose a product
                    </option>
                        <?php foreach ($products as $p) { ?>
                        <option 
                            value="<?php echo $p->id; ?>"
                            <?php
                            if (isset($product_id) && $p->id == $product_id) {
                                echo ' selected ';
                            }
                            ?>
                            >

                            <?php echo $p->product_name; ?>

                            &nbsp - &nbsp
                        <?php echo $p->product_category; ?> 
                            &nbsp - &nbsp
    <?php echo $p->product_brand; ?> 

                        </option>
<?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Seller</label>
            <div class="col-sm-4">
                <select name="seller_id" ng-model="seller_id" class="form-control"  required>
                    <option value="" selected>Choose a seller</option>
<?php foreach ($sellers as $s) { ?>
                        <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
<?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Rate</label>
            <div class="col-sm-2">


                <input type="text" value="{{price}}" ng-model="rate" class="form-control" required name="rate" placeholder=""/> 

            </div>
            <a class="btn btn-primary" ng-click="give_me_price(product_id, seller_id)" class='btn btn-primary'>Fetch price</a>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Quantity</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" 
                       ng-model="quantity"
                       required name="quantity" placeholder=""/> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Payment</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" 
                       value="{{rate * quantity||0}}"
                       required name="payment" placeholder=""/> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"> Description </label>
            <div class="col-sm-4">
                <textarea class="form-control"  name="description" placeholder=""></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Date</label>

            <div class="col-sm-4">
                <div class='input-group date' id='datetimepicker1'>

                    <input 
                        type="text" 
                        required
                        data-date-format="YYYY-MM-DD" 
                        class="form-control" 
                        name="date" 
                        value="<?php echo $set_date; ?>"
                        placeholder=""/> 
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

        </div>




        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a href="<?php echo URL_X . 'Inventory/'; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div> <!--controller div-->
<script>
    var app = angular.module('myapp', []);
    app.controller('RateController', ['$scope', '$http', function ($scope, $http) {

            $scope.price = 0;
            <?php if (isset($product_id)) { ?>
                            $scope.product_id = <?php echo $product_id; ?>;
            <?php } ?>

            <?php if (isset($seller_id)) { ?>
                            $scope.seller_id = <?php echo $seller_id; ?>;
            <?php } ?>
            $scope.give_me_price = function (product_id, seller_id) {
                $http.get('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id).success(function (data) {
                    //return data[0].product_price;
                    console.log('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id);
                    console.log(data);
                    if (data[0] != null) {
                        //console.log("Data comes here = "+data);
                        //  console.log("Data[0] comes here = "+data[0]);
                        //$scope.price = data[0].product_price;
                        $scope.rate = data[0].product_price;
                    } else {

                        $scope.rate = 0;
                    }
                }).error(function (data) {
                    console.log("error says!!!");
                    console.log('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id);
                    console.log(data);
                });
            };





        }]);

</script>