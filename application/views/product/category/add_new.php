<form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo URL_X . 'Product_category/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="seller_name" class="col-sm-2 control-label">Category Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="product_category_name" placeholder=""/> 
        </div>
    </div>
   
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Product_category/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>