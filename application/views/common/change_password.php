<div class='container'>
    <div class='row'>
        <h3 class='col-sm-offset-1'>Change password</h3>
    </div>
    <hr/>
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?>" role="alert">
            <span class="glyphicon <?php echo $this->session->flashdata('glyph'); ?>"></span>
            <strong><?php echo $this->session->flashdata('message'); ?></strong>
        </div>
    <?php } ?>
    <div class="row">
        <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo $form_submit_url; ?>" method="POST">



            <div class="form-group">
                <label class="col-sm-2 control-label">Current password</label>
                <div class="col-sm-4">
                    <input 
                        type="password" 
                        class="form-control" 
                        required 
                        name="current_pwd" placeholder=""/> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">New password</label>
                <div class="col-sm-4">
                    <input 
                        type="password" 
                        class="form-control" 
                        required name="new_pwd" placeholder=""/> 
                </div>
            </div>






            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-success" value="Change password"/>
                    <input type="reset" class="btn" value="Clear"/>
                    <a href="<?php echo URL_X . 'Product/'; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>