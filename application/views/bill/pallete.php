<?php foreach($products as $p){ ?>
<li class='list-group-item cart_items' data-product-id="<?php echo $p->id; ?>">
    <input type='hidden' name='product_id' class="p_id" value='<?php echo $p->id; ?>'/>
    <?php echo $p->product_name; ?>
    <br/>
    Rate : 
    <input type='text' name='rate' class="p_rate" style="width:50px;"/>
    &nbsp;
    Quantity : 
    <input type='text' name='quantity'  class="p_quantity" style="width:50px;"/>
    &nbsp;
    Total : 
    <input type='text' name='total' class="p_total" style="width:50px;"/>
</li>
<?php } ?>