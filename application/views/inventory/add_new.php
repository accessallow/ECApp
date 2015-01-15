<!--DONE-->
<form class="form-horizontal" data-parsley-validate role="form" action="<?php echo URL_X . 'Product/add_new'; ?>" method="POST">
    <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
        <div class="col-sm-4">
            <select name="product_category" class="form-control"  required>
                <option value="" selected>Choose a product</option>
                <?php foreach ($products as $p) { ?>
                    <option value="<?php echo $p->id ?>"> <?php echo $p->product_name; ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
<!--    <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-4">

            <select name="product_category" class="form-control"  required>
                <option value="" selected>Choose a category</option>
                <?php foreach ($categories as $c) { ?>
                    <option value="<?php echo $c->id ?>"><?php echo $c->product_category_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>-->
     <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Quantity</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="quantity" placeholder=""/> 
        </div>
    </div>
     <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Payment</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="payment" placeholder=""/> 
        </div>
    </div>
     <div class="form-group">
        <label for="product_name" class="col-sm-2 control-label">Seller</label>
        <div class="col-sm-4">
           <select name="seller" class="form-control"  required>
                <option value="" selected>Choose a seller</option>
                <?php foreach ($sellers as $s) { ?>
                    <option value="<?php echo $s->id ?>"><?php echo $s->seller_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="product_brand" class="col-sm-2 control-label">Company/Brand</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" required name="product_brand" placeholder=""/> 
        </div>
    </div>
    
    <div class="form-group">
        <label for="product_description" class="col-sm-2 control-label"> Description </label>
        <div class="col-sm-4">
            <textarea class="form-control"  name="inventory_description" placeholder=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-success" value="Save"/>
            <input type="reset" class="btn" value="Clear"/>
            <a href="<?php echo URL_X . 'Product/'; ?>" class="btn btn-primary">Back</a>
        </div>
    </div>
</form>