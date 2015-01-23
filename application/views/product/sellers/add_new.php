<!--DONE-->
<?php
$category_array = NULL;
foreach ($categories as $c) {
    $category_array[$c->id] = $c->product_category_name;
}
$product = $product[0];
?>
<div class="row well">
    <h4>
        Attaching a seller to : <?php echo $product->product_name; ?>  
    </h4>
    <a href="#" class="badge">
        Category : <?php echo $category_array[$product->product_category]; ?>
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Sellers who dont sell <?php echo $product->product_name; ?></td>
                    
                </tr>
            </thead>
            <tbody>
                <?php for($a=0;$a<10;$a++){?>
                <tr>
                    <td>Avial technologies</td>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <div class="col-md-4">
        <form class="form-horizontal"   data-parsley-validate role="form" action="<?php echo URL_X . 'Product_seller_mapping/add_new/' . $product->id; ?>" method="POST">
            <input type="hidden"  name="product_id" value="<?php echo $product->id ?>"/>
            <div class="form-group">
                <label for="seller_id" class="col-sm-2 control-label">Seller</label>
                <div class="col-sm-8">

                    <select name="seller_id" class="form-control" required>
                        <option value="" selected>Choose a seller</option>
                        <?php foreach ($sellers as $s) { ?>
                            <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="product_price" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" required name="product_price" placeholder=""/> 
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-success" value="Save"/>
                    <input type="reset" class="btn" value="Clear"/>
                    <a href="<?php echo URL_X . 'Product_seller_mapping/Sellers/' . $product->id; ?>" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-4">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Seller</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                <?php for($a=0;$a<10;$a++){?>
                <tr>
                    <td>Avial technologies</td>
                    <td>100/-</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div> <!--row-->
