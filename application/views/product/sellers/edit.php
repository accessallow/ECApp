 <?php
//    if (!isset($product)) {
//
//        $product->id = "";
//        $product->product_name = "";
//        $product->product_brand = "";
//        $product->product_category = "";
//        $product->product_description = "";
//    } else {
//        $product = $product[0];
//    }
    ?>


<form class="form-horizontal" role="form"   data-parsley-validate action="<?php echo URL_X . 'Product_seller_mapping/edit_price/'.$mapping[0]->id; ?>" method="POST">
   
    <input type="hidden" name="mapping_id" value="<?php echo $mapping[0]->id; ?>" placeholder=""/> 
    <input type="hidden" name="product_id" value="<?php echo $mapping[0]->product_id; ?>" placeholder=""/> 
    
    
    
    
    

   

    <div class="form-group">
        <label for="product_price" class="col-sm-2 control-label"> Product Price </label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="product_price" placeholder="" value="<?php echo $mapping[0]->product_price; ?>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Product_seller_mapping/sellers/'.$mapping[0]->product_id; ?>" class="btn btn-primary">Back</a>
        </div>


</form>