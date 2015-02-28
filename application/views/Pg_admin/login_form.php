<div class='container'>
    <div class='row'>
        <h3 class='col-sm-offset-1'>Programmer Login</h3>
    </div>
    <hr/>
    <div class="row">
    <form class="form-horizontal" data-parsley-validate role="form" action="<?php echo $form_submit_url; ?>" method="POST">



        <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-4">
                <input 
                    type="text" 
                    class="form-control" 
                    required 
                    name="username" placeholder=""/> 
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-4">
                <input 
                    type="password" 
                    class="form-control" 
                    required name="password" placeholder=""/> 
            </div>
        </div>






        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Login"/>
                <input type="reset" class="btn" value="Clear"/>
                <a href="<?php echo URL_X . 'Product/'; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div>
</div>