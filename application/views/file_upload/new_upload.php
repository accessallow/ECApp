<?php ?>
<div class="row">
<?php //echo $error;  ?> <!-- Error Message will show up here -->
    <?php
    echo form_open_multipart('FileUpload/upload_new', array(
        'class' => 'form-horizontal',
        'data-parsley-validate'=>true
    ));
    ?>
    <input type="hidden" name="attachment_type" value="<?php echo $attachment_type; ?>"/> 
    <input type="hidden" name="attachment_id" value="<?php echo $attachment_id; ?>"/> 


    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label">File</label>
        <div class="col-sm-4">
            <input type='file' name='userfile' size="20" class="control-label"required
                   style="width:100%;padding: 5px;"
                   />
        </div>
    </div>
    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"  required name="upload_description" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">

            <input type="submit" class="btn btn-success" value="Upload"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo $back_url; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>
</div>