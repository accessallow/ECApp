<div class="row  noprint">
    <div class="col-md-7">

    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs noprint" 
           href="<?php echo $add_link; ?>">
               <?php echo $addButtonLabel; ?>
        </a>
    </div>
</div>
<br/>
<div class="row well noprint">
    <h4><?php echo $label; ?>
        <?php
        if (isset($get_all_link)) {
            echo $get_all_link;
        }
        ?>
    </h4>
    <p>
        <span class="badge">Total bills in system: <?php echo $total_bills; ?></span>
        <span class="badge">Total money : <?php echo $total_money; ?></span>
        <span class="badge">Total cash : <?php echo $total_cash; ?></span>
        <span class="badge">Total cheque : <?php echo $total_cheque; ?></span>
        <span class="badge">Total pending : <?php echo $total_pending; ?></span>
    </p>
</div>
<table 
    class="table table-hover table-striped table-bordered"
    id="mytable">

    <thead>
        <tr>
            <td>Bill number</td>
            <td>Seller</td>
            <td>Total</td>
            <td>Cash</td>
            <td>Cheque</td>
            <td>Pending</td>
            <td>Date</td>
            <td class="noprint">Action</td>
        </tr>
    </thead>
    <tfoot>
        <tr class="noprint">
            <td>Bill number</td>
            <td>Seller</td>
            <td>Total</td>
            <td>Cash</td>
            <td>Cheque</td>
            <td>Pending</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($bills as $b) { ?>
            <tr>
                <td><?php echo $b->bill_number; ?>
                    <a href="<?php echo site_url('Bill/single/'.$b->id); ?>" class="pull-right">
                        <span class="glyphicon glyphicon-file"></span>
                    </a>
                </td>
                <td>
                    <a href="<?php echo site_url('Seller/single_seller/'.$b->seller_id); ?>">
                    <?php echo $b->seller_name; ?>
                    </a>
                </td>
                <td><?php echo $b->total/10; ?></td>
                <td><?php echo $b->cash/10; ?></td>
                <td><?php echo $b->cheque/10; ?></td>
                <td><?php echo $b->pending/10; ?></td>
                <td><?php echo $b->date; ?></td>
                <td class="noprint">
                    <a href="<?php echo site_url('Bill/update/' . $b->id); ?>" class="btn btn-primary btn-xs">Edit</a>
                    <a href="<?php echo site_url('Bill/delete/' . $b->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {



        }]);
</script>


