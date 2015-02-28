<!DOCTYPE html>
<html ng-app="myapp">
    <head>
        <meta charset="UTF-8">
        <title><?php echo MegaTitle; ?></title>
        <script src="<?php echo URL; ?>assets/angularjs/angular.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/mystyles/style.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/mystyles/print.css" media="print"/>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/DataTables-1.10.5/media/css/jquery.dataTables.css">
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><?php echo MegaTitle; ?></a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Product registration 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo URL_X . 'Activation/previous_activations'; ?>">View previous activations</a></li>
                                <li><a href="<?php echo URL_X . 'Activation/register'; ?>">Add new activation</a></li>  

                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Application 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo URL_X . 'Product'; ?>">Go to application</a></li>
                                

                            </ul>
                        </li>
                    </ul>
                    <?php if (isset($activation_status)) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if ($counter < 50) {
                                $counter_class = 'btn-danger';
                            } else {
                                $counter_class = 'btn-success';
                            }

                            if ($activation_status == true) {
                                $activation_class = "btn-success";
                                $activation_label = "Activated";
                            } else {
                                $activation_class = "btn-danger";
                                $activation_label = "Not activated";
                            }
                            $counter_percentage = round((100*$counter/3000),2);
                            ?>
                            <li>
                                <a href="#" >
                                    <span class="badge <?php echo $activation_class; ?>">
                                        <?php echo $activation_label; ?>
                                    </span>

                                    <span class="badge <?php echo $counter_class; ?>">
                                        Usage battery: <?php echo $counter_percentage; ?>%
                                    </span>

                                </a>
                            </li>

                        </ul>
                    <?php } ?>


                </div>
            </div><!-- End of its container-fluid-->
        </nav>

        <div class="container">