
<h3>Add new seller</h3>
<hr/>

<?php if($this->session->flashdata('message')){?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong><?php echo $this->session->flashdata('message');?></strong>
</div>
<?php } ?>

<form class="form-horizontal" role="form"   data-parsley-validate action="<?php echo URL_X . 'Seller/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="seller_name" class="col-sm-2 control-label">Seller Name</label>
        <div class="col-sm-4">
            <input type="text"
                   autofocus="autofocus"
                   accesskey="v"
                   required class="form-control" name="seller_name" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="seller_phone_number" class="col-sm-2 control-label">Phone number</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="b"
                   required class="form-control" name="seller_phone_number" placeholder=""/> 
        </div>
    </div>
     <div class="form-group">
        <label for="seller_mail_id" class="col-sm-2 control-label">Email-id</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="n"
                   required class="form-control" name="seller_mail_id" placeholder=""/> 
        </div>
    </div>
     <div class="form-group">
        <label for="seller_tin_number" class="col-sm-2 control-label">Tin number</label>
        <div class="col-sm-4">
            <input type="text" 
                   accesskey="m"
                   required class="form-control" name="seller_tin_number" placeholder=""/> 
        </div>
    </div>
    <div class="form-group">
        <label for="seller_address" class="col-sm-2 control-label"> Address </label>
        <div class="col-sm-4">
            <textarea class="form-control" 
                      accesskey=","
                      required name="seller_address" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" 
                   accesskey="s"
                   class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Seller/'; ?>" 
               accesskey="c"
               class="btn btn-primary">Back</a>
        </div>
    </div>
</form>