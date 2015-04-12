<div class='container'>
    
    <hr/>
    <div class="row">
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok"></span>
            <strong>Product key created</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <table class="table table-striped">
                <tbody>
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
                                href="<?php echo $forward_link; ?>"
                                >Home</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>