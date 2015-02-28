<?php

$continue_link = site_url('Product');
?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong>Activation successful</strong>
</div>
<div class="row">
    <div class="col-md-5">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>Registered to</td>
                <td><?php echo $activator_name; ?></td>
            </tr>
            <tr>
                <td>Product code</td>
                <td><?php echo $product_code; ?></td>
            </tr>
            <tr>
                <td>Product key</td>
                <td><?php echo $product_key; ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <br/>
                    <a 
                        class="btn btn-success"
                        href="<?php echo $continue_link; ?>"
                        >Continue using product</a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>