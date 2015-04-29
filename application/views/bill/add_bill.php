<?php
if (isset($edit)) {
    $heading = "Edit payment bill";
} else {
    $heading = "Add new payment bill";
}
?>

<h3>
    <?php echo $heading; ?>
</h3>
<hr/>


<?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>" role="alert">
        <span class="glyphicon <?php echo $this->session->flashdata('glyphicon_class'); ?>"></span>
        <strong><?php echo $this->session->flashdata('message'); ?></strong>
    </div>
<?php } ?>


<div ng-controller="RateController">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo $form_submit_url; ?>" method="POST">
        <?php if (isset($edit)) { ?>
            <input type="hidden" name="bill_id" value="<?php echo $bill->id; ?>"/>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Bill number</label>
            <div class="col-sm-2">


                <input type="text"  
                       autofocus="autofocus"
                       ng-model="bill_number" 
                       class="form-control" 
                       required  
                       name="bill_number"
                       placeholder=""/> 

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
            <label class="col-sm-2 control-label">Total</label>
            <div class="col-sm-2">


                <input type="number"  
                       
                       ng-model="mytotal" 
                       name="total"
                       class="form-control" 
                       required 
                       placeholder=""/> 

            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Cash</label>
            <div class="col-sm-2">


                <input type="number"  

                       
                       ng-model="cash" 
                       class="form-control" 
                       required
                       name="cash"
                       placeholder=""/> 

            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Cheque</label>
            <div class="col-sm-2">


                <input type="number"  
                       
                       ng-model="cheque" 
                       class="form-control" 
                       required
                       name="cheque"
                       placeholder=""/> 

            </div>

        </div>



        <div class="form-group">
            <label class="col-sm-2 control-label">Pending</label>
            <div class="col-sm-2">


                <input type="number"  
                       value="{{ mytotal - cheque - cash ||0 }}"

                       class="form-control" 
                       required
                       name="pending"
                       placeholder=""/> 

            </div>
        </div>



        <div class="form-group">
            <label class="col-sm-2 control-label">Date</label>

            <div class="col-sm-4">
                <div class='input-group date' id='datetimepicker1'>

                    <input type="text" 

                           ng-model="mydate"
                           data-date-format="YYYY-MM-DD"
                           class="form-control"
                           name="date" 
                           placeholder=""/> 

                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>


                </div>

            </div>

        </div>




        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a accesskey="c" href="<?php echo URL_X . 'Bill/dashboard'; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div> <!--controller div-->

<script>
    var app = angular.module('myapp', []);
    app.controller('RateController', ['$scope', '$http', function ($scope, $http) {


<?php if (isset($edit)) { ?>
                $scope.bill_number = '<?php echo $bill->bill_number; ?>';
                $scope.seller_id = <?php echo $bill->seller_id; ?>;
                $scope.mytotal = <?php echo $bill->total; ?>;
                $scope.cash = <?php echo $bill->cash; ?>;
                $scope.cheque = <?php echo $bill->cheque; ?>;
                $scope.pending = <?php echo $bill->pending; ?>;
                $scope.mydate = '<?php echo $bill->date; ?>';
<?php } else { ?>
                $scope.seller_id = <?php echo $seller_id; ?>;
                $scope.price = 0;
                $scope.mydate = '<?php echo $set_date; ?>';
<?php } ?>
        }]);
</script>