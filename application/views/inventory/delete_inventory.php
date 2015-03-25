<?php if (isset($product_name)) { ?>


    <form action="<?php echo URL_X . 'Inventory/delete'; ?>" method="POST">
        <input type="hidden" name="inventory_id" value="<?php echo $inventory_id; ?>"/>
        <p>
            Inventory entry id : <?php echo $inventory_id;?>,<br/>
            Product : <?php echo $product_name;?>,<br/>
            Quantity : <?php echo $quantity;?>,<br/>
            Payment : Rs.<?php echo $payment;?>/-,<br/>
            Date : <?php echo $date;?>,<br/>
            Seller : <?php echo $seller_name;?>,<br/>
            Description : <?php echo $description;?> <br/><hr/>
        
        <strong>    Are you sure want to delete it? </strong>

        </p>
        <p>
            <input accesskey="x" type="submit" class="btn btn-danger" value="Delete - x"/>
            <a accesskey="c" href="<?php echo URL_X . 'Inventory/'; ?>" class="btn btn-primary">Cancel - c</a>
        </p>
    </form>

    <?php
} else {
    echo "Something gone errored!!!Dont worry our data is always safe...its just a script error";
}
?>