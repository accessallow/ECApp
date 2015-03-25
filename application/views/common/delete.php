<?php 
// Totally resusable delete template :)
// Expects : 
// $delete_form_url
// $item_id
// $confirmation_line
// $back_url
?>
<form 
    action="<?php echo $delete_form_url;?>" 
    method="POST">
    <input type="hidden" name="id" value="<?php echo $item_id;?>">
<p><?php echo $confirmation_line;?></p>
<p>
    <input accesskey="x" type="submit" class="btn btn-danger" value="Delete - x"/>
    <a accesskey="c" href="<?php echo $back_url;?>" class="btn btn-primary">Cancel - c</a>
</p>
</form>

