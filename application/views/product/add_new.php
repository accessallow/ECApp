<!--DONE-->
<h3>Add new product</h3>
<hr/>

<?php if($this->session->flashdata('message')){?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong><?php echo $this->session->flashdata('message');?></strong>
</div>
<?php } ?>


<form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Product/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="product_name" placeholder=""/> 
        </div>
    </div>
   
    <div class="form-group" ng-controller="ProductController">
        <label for="product_category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-4">

            <select name="product_category" class="form-control"  required ng-model="category">
                <option value="" selected>Choose a category</option>
                <?php foreach ($categories as $c) { ?>
                    <option value="<?php echo $c->id ?>"><?php echo $c->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
     <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Company/Brand</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="product_brand" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"   name="product_description" placeholder=""></textarea>
        </div>
    </div>
    
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Product/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>

<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {
            
            $scope.category = <?php echo $category_id;?>;

        }]);
</script>