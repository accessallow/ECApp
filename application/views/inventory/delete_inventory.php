<?php 
if(isset($product)){
    
$product = $product[0];
?>
<form action="<?php echo URL_X.'Product/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $product->id;?>">
<p>Are you sure want to delete <strong><?php echo $product->product_name;?></strong>?</p>
<p>
    <input type="submit" class="btn btn-danger" value="Delete"/>
    <a href="<?php echo URL_X.'Product/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>