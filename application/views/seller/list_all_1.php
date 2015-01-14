<div class="row" style="text-align: right;">
    <a class="btn btn-success btn-xs" href="<?php echo URL_X.'Seller/add_new';?>">Add new Seller</a>
</div>
<br/>
<table class="table table-hover table-striped">
<?php
foreach($sellers as $s){
?>
    <tr>
    <td><?php echo $s->seller_name;?></td>
    <td><?php echo $s->seller_phone_number;?></td>
    <td><?php echo $s->seller_address;?></td>
    <td>
        <a href="<?php echo URL_X.'Seller/edit/'.$s->id;?>" class="btn  btn-primary btn-xs">Edit</a>
        <a href="<?php echo URL_X.'Seller/delete/'.$s->id;?>" class="btn  btn-danger btn-xs">Delete</a>
    </td>
    </tr>
<?php
}
?>
</table>