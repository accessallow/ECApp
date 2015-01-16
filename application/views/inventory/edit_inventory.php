<!--DONE-->
<?php
$inventory = $inventory[0];
?>
<form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Inventory/edit'; ?>" method="POST">
    
    <input type="hidden" name="inventory_id" value="<?php echo $inventory->id; ?>"/>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <select name="product_id" class="form-control"  required>
                <option value>Choose a product</option>
                <?php foreach($products as $p) { ?>
                    <option value="<?php echo $p->id ?>" <?php 
                    
                    if($p->id==$inventory->product_id) echo "selected";
                    
                    ?> > <?php echo $p->product_name; ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="quantity" value="<?php echo $inventory->quantity; ?>" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Payment</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" value="<?php echo $inventory->payment; ?>" required name="payment" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">
            <select name="seller_id" class="form-control"  required>
                <option value="" selected>Choose a seller</option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>" <?php 
                        if($s->id==$inventory->seller_id){
                           echo "selected";
                        }
                    ?> ><?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date</label>

        <div class="col-sm-4">
            <div class='input-group date' id='datetimepicker1'>

                <input type="text" data-date-format="DD/MM/YYYY" value="<?php echo $inventory->date;?>" class="form-control" name="date" placeholder=""/> 
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

    </div>

   

    <div class="form-group">
        <label class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"  name="description" placeholder=""> <?php echo $inventory->description; ?> </textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Inventory/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>