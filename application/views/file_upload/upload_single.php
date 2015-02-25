<?php
//$image_fq_name = base_url('assets/uploads/upload_sample.jpg');
//$back_url = "#";
//$form_submit_url = "#";
?>
<div class="row">
    <div class="col-md-6">
        <img src="<?php echo $image_fq_name; ?>" 
             class="img-thumbnail"/>
    </div>
    <div class="col-md-6">
        <form action="<?php echo $form_submit_url; ?>"
              class="form-horizontal"
              method="post">
            
            <input type="hidden" name="attachment_type" value="<?php echo $attachment_type; ?>"/> 
            <input type="hidden" name="attachment_id" value="<?php echo $attachment_id; ?>"/> 
            
            <div class="form-group">
                <label for="upload_description" class="col-sm-2 control-label"> Description </label>
                <div class="col-sm-8">
                    <textarea class="form-control"  
                              rows="5" 
                              required 
                              name="upload_description" 
                              placeholder="">

                        <?php echo $description; ?>
                    </textarea>
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
</div>