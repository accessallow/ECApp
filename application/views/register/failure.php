<?php

$continue_link = site_url('Activation/register');
?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-remove"></span>
    <strong>Activation failure!</strong> Credentials are invalid.
</div>
<div class="row">
    <div class="col-md-5">

        <a 
            class="btn btn-primary"
            href="<?php echo $continue_link; ?>"
            >Back to activation</a>
    </div>
</div>