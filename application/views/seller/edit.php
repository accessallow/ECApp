<form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo URL_X . 'Seller/edit'; ?>" method="POST">
    <?php
    if (!isset($seller)) {

        $seller->id = "";
        $seller->seller_name = "";
        $seller->seller_phone_number = "";
        $seller->seller_address = "";
    } else {
        $seller = $seller[0];
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $seller->id; ?>" placeholder=""/> 
    <div class="form-group">
        <label for="seller_name" class="col-sm-2 control-label">Seller Name</label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="seller_name" value="<?php echo $seller->seller_name; ?>" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="seller_phone_number" class="col-sm-2 control-label">Phone number</label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="seller_phone_number"  value="<?php echo $seller->seller_phone_number; ?>" placeholder=""/>
        </div>
    </div>
    <div class="form-group">
        <label for="seller_mail_id" class="col-sm-2 control-label">Email-id</label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="seller_mail_id" 
                   value="<?php echo $seller->mail_id; ?>"
                   placeholder=""/> 
        </div>
    </div>
     <div class="form-group">
        <label for="seller_tin_number" class="col-sm-2 control-label">Tin number</label>
        <div class="col-sm-4">
            <input type="text" required class="form-control" name="seller_tin_number" 
                   value="<?php echo $seller->tin_number; ?>"
                   placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="seller_address" class="col-sm-2 control-label"> Address </label>
        <div class="col-sm-4">
            <textarea name="seller_address" required class="form-control" placeholder=""> <?php echo $seller->seller_address; ?> </textarea>
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