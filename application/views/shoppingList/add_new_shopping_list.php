<?php ?>
<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal" role="form" data-parsley-validate action="<?php echo $form_submit_url; ?>" method="POST">

            <?php if (isset($edit)) { ?>
                <input 
                    type="hidden" 
                    name="list_id" 
                    value="<?php echo $list_id; ?>"/>

            <?php } ?>


            <div class="form-group">
                <label class="col-sm-3">List name</label>
                <div class="col-sm-8">
                    <input 
                        autofocus="autofocus"
                        type="text" 
                        class="form-control" 
                        name="ListName" 
                        <?php
                        if (isset($edit)) {
                            echo 'value="' . $ListName . '" ';
                        }
                        ?>
                        required>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3">Date Created</label>
                <div class="col-sm-8">
                    <div class='input-group date' id='datetimepicker1'>

                        <input 
                            type="text" 
                            data-date-format="YYYY-MM-DD" 
                            class="form-control" 
                            name="DateCreated" 
                            <?php
                            if (isset($edit)) {
                                echo 'value="' . $DateCreated . '" ';
                            }
                            ?>
                            required/> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

            </div>



            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <input type="submit" class="btn btn-success" value="Save"/>
                    <input type="reset" class="btn" value="Clear"/>
                    <a href="<?php echo $back_url; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
 var app = angular.module('myapp', []);
</script>

