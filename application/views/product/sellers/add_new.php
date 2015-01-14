<!--DONE-->
<?php

$category_array=NULL;
foreach ($categories as $c){
    $category_array[$c->id] = $c->product_category_name;
}

?>
<div class="row">
    <h3><?php echo $product[0]->product_name; ?>  
    <small><?php echo $category_array[$product[0]->product_category]; ?></small></h3>
</div>
<form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo URL_X . 'Product_seller_mapping/add_new/'.$product[0]->id; ?>" method="POST">
    <input type="hidden"  name="product_id" value="<?php echo $product[0]->id?>"/>
    <div class="form-group">
        <label for="seller_id" class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">

            <select name="seller_id" class="form-control" required>
                <option value="" selected>Choose a seller</option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="product_price" class="col-sm-2 control-label">Price</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="product_price" placeholder=""/> 
        </div>
    </div>

   
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Product_seller_mapping/Sellers/'.$product[0]->id; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>