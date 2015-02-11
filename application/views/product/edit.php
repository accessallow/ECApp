<form class="form-horizontal" role="form"  data-parsley-validate action="<?php echo URL_X . 'Product/edit'; ?>" method="POST">
    <?php
    if (!isset($product)) {

        $product->id = "";
        $product->product_name = "";
        $product->product_brand = "";
        $product->product_category = "";
        $product->product_description = "";
    } else {
        $product = $product[0];
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $product->id; ?>" placeholder="" required /> 
    <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="product_name" required value="<?php echo $product->product_name; ?>" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Company/Brand</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="product_brand" value="<?php echo $product->product_brand; ?>" placeholder=""/> 
        </div>
    </div>

    <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-4">

            <select name="product_category" class="form-control" required>
                <option value="">Choose a category</option>
                <?php foreach ($categories as $c) { ?>
                    <option value="<?php echo $c->id ?>"
                    <?php if ($c->id == $product->product_category) echo "selected"; ?>    
                            >
                        <?php echo $c->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"  name="product_description" placeholder=""><?php echo $product->product_description; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="stock" class="col-sm-2 control-label">Stock</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="stock" placeholder="stock"
                   value="<?php echo $product->stock; ?>"/> 
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Product/'; ?>" class="btn btn-primary">Back</a>
        </div>


</form>