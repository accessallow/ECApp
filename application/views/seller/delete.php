<?php 
if(isset($seller)){
    
$seller = $seller[0];
?>
<form action="<?php echo URL_X.'Seller/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $seller->id;?>">
<p>Are you sure want to delete <strong><?php echo $seller->seller_name;?></strong>?</p>
<p>
    <input type="submit" class="btn btn-danger" value="Delete"/>
    <a href="<?php echo URL_X.'Seller/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>