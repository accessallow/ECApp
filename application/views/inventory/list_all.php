<!--DONE-->
<?php
$assoc_array=NULL;
foreach ($categories as $c){
    $assoc_array[$c->id] = $c->product_category_name;
}

?>
<div class="row" style="text-align: right;">
    <a class="btn btn-success btn-xs" href="<?php echo URL_X.'Product/add_new';?>">Add new Product</a>
</div>
<br/>
<table class="table table-hover table-striped">
<?php
//$this->load->model("product_category_model");
foreach($products as $s){
?>
    <tr>
    <td>
        <a href="<?php echo URL_X.'Product_seller_mapping/sellers/'.$s->id;?>">
        <?php echo $s->product_name;?>
        </a>
    </td>
    <td><?php echo $s->product_brand;?></td>
   <?php // $product_category = $this->product_category_model->get_category_name($s->product_category); ?>
    <td><?php echo $assoc_array[$s->product_category];?></td>
    <td><?php echo $s->product_description;?></td>
    <td>
        <a href="<?php echo URL_X.'Product/edit/'.$s->id;?>" class="btn  btn-primary btn-xs">Edit</a>
        <a href="<?php echo URL_X.'Product/delete/'.$s->id;?>" class="btn  btn-danger btn-xs">Delete</a>
    </td>
    </tr>
<?php
}
?>
</table>