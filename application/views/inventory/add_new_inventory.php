<!--DONE-->
<form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Inventory/add_new'; ?>" method="POST">
    <div class="form-group">
        <label class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <select name="product_id" class="form-control"  required>
                <option value="" selected>Choose a product</option>
                <?php foreach ($products as $p) { ?>
                    <option value="<?php echo $p->id ?>"> <?php echo $p->product_name; ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="quantity" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Payment</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="payment" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">
            <select name="seller_id" class="form-control"  required>
                <option value="" selected>Choose a seller</option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Date</label>

        <div class="col-sm-4">
            <div class='input-group date' id='datetimepicker1'>

                <input type="text" data-date-format="DD/MM/YYYY" class="form-control" name="date" placeholder=""/> 
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

    </div>

   

    <div class="form-group">
        <label class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"  name="description" placeholder=""></textarea>
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