<!--DONE-->
<?php
$inventory = $inventory[0];
?>
<div ng-controller="RateController">
<form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Inventory/edit'; ?>" method="POST">
    
    <input type="hidden" name="inventory_id" value="<?php echo $inventory->id; ?>"/>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <select name="product_id" class="form-control"  required>
                <option value>Choose a product</option>
                <?php foreach($products as $p) { ?>
                    <option value="<?php echo $p->id ?>" <?php 
                    
                    if($p->id==$inventory->product_id) echo "selected";
                    
                    ?> > <?php echo $p->product_name; ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">
            <select name="seller_id" class="form-control"  required>
                <option value="" selected>Choose a seller</option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>" <?php 
                        if($s->id==$inventory->seller_id){
                           echo "selected";
                        }
                    ?> ><?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
            <label class="col-sm-2 control-label">Rate</label>
            <div class="col-sm-2">


                <input type="text" 
                       value="<?php echo $inventory->rate;?><?php ?>" 
                       class="form-control" 
                      
                       required name="rate" placeholder=""/> 

            </div>
            <a class="btn btn-primary" ng-click="give_me_price(product_id, seller_id)" class='btn btn-primary'>Fetch price</a>
        </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-4">
            <input type="text"
                   
                   class="form-control" required name="quantity" value="<?php echo $inventory->quantity; ?>" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Payment</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" value="{{payment}}" required name="payment" placeholder=""/> 
            
              
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Date</label>

        <div class="col-sm-4">
            <div class='input-group date' id='datetimepicker1'>

                <input type="text" required data-date-format="YYYY-MM-DD" value="<?php echo $inventory->date;?>" class="form-control" name="date" placeholder=""/> 
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

    </div>

   

    <div class="form-group">
        <label class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"  name="description" placeholder=""> <?php echo $inventory->description; ?> </textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a accesskey="c" href="<?php echo URL_X . 'Inventory/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('RateController', ['$scope', '$http', function ($scope, $http) {

            $scope.price = 0;
            $scope.payment = <?php echo $inventory->payment; ?>;
            $scope.refreshPayment = function(){
                console.log("Quantity = "+quantity+" Rate = "+rate);
                $scope.payment = quantity*rate;
            };
            
            $scope.give_me_price = function (product_id, seller_id) {
                $http.get('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id).success(function (data) {
                    //return data[0].product_price;
                    console.log('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id);
                    console.log(data);
                    if (data[0] != null) {
                        //console.log("Data comes here = "+data);
                       //  console.log("Data[0] comes here = "+data[0]);
                        $scope.price = data[0].product_price;
                    } else {

                        $scope.price = 0;
                    }
                }).error(function(data){
                    console.log("error says!!!");
                    console.log('<?php echo URL_X; ?>Product/give_me_price?product_id=' + product_id + '&&seller_id=' + seller_id);
                    console.log(data);
                });
            };





        }]);

</script>