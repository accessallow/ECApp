<?php
$activation_link = site_url("Activation/register");
?>
<h3>
    <span class="glyphicon glyphicon-qrcode"></span>
    Activate your product</h3>
<hr/>
<div class="row">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo $activation_link; ?>" method="POST">



        <div class="form-group">
            <label class="col-sm-2 control-label">Product code</label>
            <div class="col-sm-4">
                <input 
                    type="text" 
                    class="form-control" 
                    required 
                    name="product_code" placeholder=""/> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Product Key</label>
            <div class="col-sm-4">
                <input 
                    type="text" 
                    class="form-control" 
                    required name="product_key" placeholder=""/> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Activator name</label>
            <div class="col-sm-4">
                <input 
                    type="text" 
                    class="form-control" 
                    required 
                    name="activator_name" placeholder=""/> 
            </div>
        </div>





        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Activate"/>
                <input type="reset" class="btn" value="Clear"/>
                <a href="<?php echo URL_X . 'Activation/'; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div>