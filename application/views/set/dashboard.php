<div class="row" ng-controller="SetController">
    <form action="<?php echo $form_submit_url; ?>" method="post"  class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">Date</label>

            <div class="col-sm-4">
                <div class='input-group date' id='datetimepicker1'>

                    <input type="text" 

                           data-date-format="YYYY-MM-DD"
                           class="form-control"
                           name="date" 
                           placeholder=""/> 

                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>


                </div>

            </div>
            <div class="col-sm-2">
                <span class="badge">
                    <?php echo $message_date; ?>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="product_category" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-4">

                <select name="category_id" class="form-control"  ng-model="category_id">
                    <option value="" selected>Choose a category</option>
                    <?php foreach ($categories as $c) { ?>
                        <option value="<?php echo $c->id ?>"><?php echo $c->product_category_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-2">
                <span class="badge">
                    <?php echo $message_category; ?>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Seller</label>
            <div class="col-sm-4">
                <select name="seller_id" ng-model="seller_id" class="form-control"  >
                    <option value="" selected>Choose a seller</option>
                    <?php foreach ($sellers as $s) { ?>
                        <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-2">
                <span class="badge">
                    <?php echo $message_seller; ?>
                </span>
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
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('SetController', ['$scope', '$http', function ($scope, $http) {
<?php if (isset($category_id)) { ?>
                $scope.category_id = <?php echo $category_id; ?>;
<?php } ?>
<?php if (isset($seller_id)) { ?>
                $scope.seller_id = <?php echo $seller_id; ?>;
<?php } ?>
        }]);

</script>