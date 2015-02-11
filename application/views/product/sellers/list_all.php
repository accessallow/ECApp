<!--DONE-->
<!-- View: product/sellers/list_all -->
<?php
$category_array=NULL;
foreach ($categories as $c){
    $category_array[$c->id] = $c->product_category_name;
}
$sellers_array = NULL;
foreach($sellers as $s){
    $sellers_array[$s->id] = $s->seller_name;
}


?>
<div class="row">
    <div class="col-md-10">
        <h3><?php echo $product[0]->product_name;?></h3>
        <h4><small><?php echo $category_array[$product[0]->product_category];?></small></h4>
    </div>
    <div class="col-md-2" style="text-align: right;">
    <a class="btn btn-success btn-xs" href="<?php echo URL_X.'Product_seller_mapping/add_new/'.$product[0]->id;?>">Add new Mapping</a>
    </div>
</div>
<br/>
<table class="table table-hover table-striped">
    <thead>
        <tr style="font-weight: bolder;">
            <td>Seller</td>
            <td>Price</td>
            <td>Action</td>
        </tr>
    </thead>
<?php
//$this->load->model("product_category_model");
foreach($list as $l){
?>
    <tr>
    <td>
        <a href="<?php echo URL_X.'Seller/purchase/'.$l->id;?>">
        <?php echo $sellers_array[$l->seller_id];?>
        </a>
    </td>
<!--    <td><?php echo $l->seller_id;?></td>-->
  
<!--    <td><?php //echo $category_array[$l->product_category];?></td>-->
    <td><?php echo $l->product_price;?></td>
    <td>
        <a href="<?php echo URL_X.'Product_seller_mapping/edit/'.$l->id;?>" class="btn  btn-primary btn-xs">Edit price</a>
        <a href="<?php echo URL_X.'Product_seller_mapping/delete/'.$l->id;?>" class="btn  btn-danger btn-xs">Delete</a>
    </td>
    </tr>
<?php
}
?>
</table>