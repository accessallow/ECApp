<?php
if (isset($mapping_id)) {
   
    ?>

    <form action="<?php echo URL_X . 'Product_seller_mapping/delete_a_mapping/' . $mapping_id; ?>" method="POST">
        <input type="hidden" name="mapping_id" value="<?php echo $mapping_id; ?>">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <p>Are you sure want to delete entry of <strong>
                <?php echo $product_name; ?> </strong> <br/>
                Seller : <strong><?php echo $seller_name; ?> </strong><br/>
                Price : <strong><?php echo $product_price; ?></strong>?</p>
        <p>
            <input type="submit" class="btn btn-danger" value="Delete"/>
<!--            line below means in product seller mapping get all the 
                sellers for product having id = product_id-->

            <a href="<?php echo URL_X . 'Product_seller_mapping/add_new_seller_to_a_product/'.$product_id; ?>" class="btn btn-primary">Cancel</a>
        </p>
    </form>

    <?php
}else{
    echo "nothing!!!";
}
?>