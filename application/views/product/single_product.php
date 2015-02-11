<div class="row">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $product_name; ?>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Brand</td>
                            <td><?php echo $brand; ?></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><?php echo $category; ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?php echo $description; ?></td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td>
                                <a href="<?php echo $product_edit_link; ?>" class="btn btn-primary btn-xs">Edit</a>
                                <a href="<?php echo $product_delete_link; ?>" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Stats
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Sellers</td>
                            <td><?php echo $sellers_count; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Best rate</td>
                            <td><?php echo $best_rate; ?></td>
                        </tr>
                         <tr>
                            <td>Best seller</td>
                            <td><?php echo $best_seller; ?></td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td>
                                <span class="pull-left"><?php echo $stock; ?></span>
                                <span class="pull-right">
                                <a href="<?php echo $do_stock_zero_link; ?>" class="btn btn-danger btn-xs">Do Stock Zero</a>
                                </span>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
