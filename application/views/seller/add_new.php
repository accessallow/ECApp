<form class="form-horizontal" role="form"   data-parsley-validate action="<?php echo URL_X . 'Seller/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="seller_name" class="col-sm-2 control-label">Seller Name</label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="seller_name" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="seller_phone_number" class="col-sm-2 control-label">Phone number</label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="seller_phone_number" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="seller_address" class="col-sm-2 control-label"> Address </label>
        <div class="col-sm-4">
            <textarea class="form-control" required name="seller_address" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Seller/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>