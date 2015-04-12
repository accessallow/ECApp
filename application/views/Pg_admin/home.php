<div class='container'>
    <h3>
        <span class='glyphicon glyphicon-briefcase'></span>
        &nbsp;
        Welcome Pankaj!!!</h3>
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
                <label class="col-sm-2 control-label">Date</label>

                <div class="col-sm-4">
                    <div class='input-group date' id='datetimepicker_x'>

                        <input 
                            type="text" 
                            required
                            data-date-format="YYYY-MM-DD*hh-mm-ss" 
                            class="form-control" 
                            name="datetime" 
                            
                            placeholder=""/> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Lease</label>
                <div class="col-sm-4">
                    <input 
                        type="text" 
                        class="form-control" 
                        required name="lease" placeholder=""/> 
                </div>
            </div>






            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-success" value="Create"/>
                    <input type="reset" class="btn" value="Clear"/>
                    <a href="<?php echo URL_X . 'Pg_admin/logout'; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>
    </div>

</div>
