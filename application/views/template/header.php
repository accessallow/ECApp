<!DOCTYPE html>
<html ng-app="myapp">
    <head>
        <meta charset="UTF-8">
        <title>Krishna Electronics</title>
        <script src="<?php echo URL; ?>assets/angularjs/angular.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/style.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/bootstrap3/css/bootstrap-datetimepicker.min.css" />
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Krishna Electronics</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Products 
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo URL_X . 'Product/'; ?>">List all products</a></li>
                            <li><a href="<?php echo URL_X . 'Product/add_new'; ?>">Add new product</a></li>  
                            <li class="divider"></li>
                            <li><a href="<?php echo URL_X . 'Product_category/'; ?>">Categories</a></li>
                            <li><a href="<?php echo URL_X . 'Product_category/add_new'; ?>">Add new category</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Inventory
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo URL_X . 'Inventory/'; ?>">Inventory List</a></li>
                            <li><a href="<?php echo URL_X . 'Inventory/add_new'; ?>">Add new purchase</a></li>  
                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Seller 
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo URL_X . 'Seller/'; ?>">List all sellers</a></li>
                            <li><a href="<?php echo URL_X . 'Seller/add_new'; ?>">Add new</a></li>

                           
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">