<nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Programmer's Control Panel</a>
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
                                <li class='divider'></li>
                                <li><a href="<?php echo URL_X . 'Pg_admin/create_key'; ?>">Create credentials</a></li>  
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
                  
                        <ul class="nav navbar-nav navbar-right">
                           
                           <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Action 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo URL_X . 'Pg_admin/logout'; ?>">Logout</a></li>
                                

                            </ul>
                        </li>

                        </ul>
                   

                </div>
            </div><!-- End of its container-fluid-->
        </nav>