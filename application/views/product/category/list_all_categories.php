<div class="row" style="text-align: right;">
    <a class="btn btn-success btn-xs" href="<?php echo URL_X.'Product_category/add_new';?>">Add new category</a>
</div>
<br/>
<div class="row">
    <div class="col-md-5">
<table class="table table-hover table-striped">
<?php
foreach($categories as $c){
?>
    <tr>
    <td>
        <a href="<?php echo URL_X;?>Product?category_id=<?php echo $c->id;?>">
        <?php echo $c->product_category_name;?>
        </a>
    </td>
    
    <td style="text-align: right;">
        <a href="<?php echo URL_X.'Product_category/edit/'.$c->id;?>" class="btn  btn-primary btn-xs">Edit</a>
        <a href="<?php echo URL_X.'Product_category/delete/'.$c->id;?>" class="btn  btn-danger btn-xs">Delete</a>
    </td>
    </tr>
<?php
}
?>
</table>
         </div>
</div>