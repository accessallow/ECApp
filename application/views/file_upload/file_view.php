<html>
    <head>
        <title>Upload Form</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap3/css/bootstrap.min.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap3/css/bootstrap-theme.min.css'); ?>"/>
        <script src="<?php echo base_url('assets/bootstrap3/jquery-2.1.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap3/css/bootstrap.min.css'); ?>"></script>
    </head>
    <body>
        <div class="container">
            <div class="row well">
                <?php echo $error; ?> <!-- Error Message will show up here -->
                <?php
                echo form_open_multipart('FileUpload/upload', array(
                    'class' => 'form-horizontal'
                ));
                ?>
                <div class="form-group">
                    <input type='file' name='userfile' size='20' class="control-label"/>
                    <input type='submit' name='submit' value='upload'/> 
                </div>
                </form>
            </div>
            <div class="row">
                <?php
                foreach ($files as $file) {
                    if ($file == '..' || $file == '.')
                        break;
                    ?>
                    <div class="col-md-2" 
                         style="text-align: center;"
                         >
                        <img src="<?php echo base_url() . 'assets/uploads/' . $file; ?>"
                             style="width: 100px;height:100px;"
                             class="img-thumbnail"
                             />
                        <br/>
                        <a href="<?php echo base_url() . 'assets/uploads/' . $file; ?>"><?php echo $file; ?></a>
                    </div>
                <?php } ?>

            </div>
        </div><!-- End : Container -->
    </body>
</html>