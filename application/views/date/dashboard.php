<div class="row">
    <form action="<?php echo $form_submit_url; ?>" method="post">
         <div class="form-group">
             <p> <?php echo $message; ?></p>
         </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Date</label>

            <div class="col-sm-4">
                <div class='input-group date' id='datetimepicker1'>

                    <input type="text" 
                           required 
                           data-date-format="YYYY-MM-DD"
                           class="form-control"
                           name="date" 
                           placeholder=""/> 

                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

                <input type="submit" class="btn btn-success" value="Save"/>
                <input type="reset" class="btn" value="Clear"/>
                <a href="<?php echo $back_url; ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>
</div>