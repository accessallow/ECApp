<form class="form-horizontal" role="form"   data-parsley-validate action="<?php echo URL_X . 'Product_category/edit'; ?>" method="POST">
    <?php
    if (!isset($category)) {

        $category->id = "";
        $category->product_category_name = "";
       
    } else {
        $category = $category[0];
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $category->id; ?>" placeholder=""/> 
    <div class="form-group">
        <label for="seller_name" class="col-sm-2 control-label">Category Name</label>
        <div class="col-sm-4">
            <input type="text" 
                   autofocus="autofocus"
                   class="form-control" required name="product_category_name" value="<?php echo $category->product_category_name; ?>" placeholder=""/> 
        </div>
    </div>
   

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
           <input accesskey="s" type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a accesskey="c" href="<?php echo URL_X . 'Product_category/'; ?>" class="btn btn-primary">Back</a>
        </div>

    </div>


</form>