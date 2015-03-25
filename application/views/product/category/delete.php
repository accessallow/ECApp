<?php 
if(isset($category)){
    
$category = $category[0];
?>
<form action="<?php echo URL_X.'Product_category/delete';?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $category->id;?>">
<p>Are you sure want to delete <strong><?php echo $category->product_category_name;?></strong>?</p>
<p>
    <input accesskey="x" type="submit" class="btn btn-danger" value="Delete"/>
    <a accesskey="c" href="<?php echo URL_X.'Product_category/';?>" class="btn btn-primary">Cancel</a>
</p>
</form>

<?php 
}
?>