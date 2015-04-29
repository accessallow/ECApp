<!--DONE-->
<?php
//$assoc_array = NULL;
//foreach ($categories as $c) {
//    $assoc_array[$c->id] = $c->product_category_name;
//}
?>
<div ng-controller="ProductController">
    <div class="row  noprint">
        <div class="col-md-7">
            <form class="form-inline">
                <div class="form-group">
                    <input placeholder="Search..." class="form-control noprint" 
                           autofocus
                           type="text" ng-model="m"/>
                </div>
            </form>
        </div>
        <div class="col-md-5" style="text-align: right;">
            <a class="btn btn-success btn-xs noprint" 
               href="<?php echo $add_link; ?>">
                   <?php echo $addButtonLabel; ?>
            </a>
        </div>
    </div>
    <div class="row well noprint">
        <h4><?php echo $label; ?>
            <?php
            if (isset($get_all_link)) {
                echo $get_all_link;
            }
            ?>
        </h4>
        <p>
            <span class="badge">Total products in catalog: <?php echo $total_products; ?></span>
            <span class="badge">Selected products : {{products.length}}</span>
            <?php if (isset($total_products_under_this_category)) { ?>
                <span class="badge">Total products under <?php echo $category_name; ?> : <?php echo $total_products_under_this_category; ?></span>
            <?php } ?>
            <span class="badge">Total uncategorized products: <?php echo $total_uncategorized_products; ?></span>
        </p>
    </div>


    <div class="row printonly">
        <div class="col-sm-6" style="text-align: right;">
            <?php echo SHOP_NAME; ?>
            <br/>
            <?php echo SHOP_ADDR; ?>
            <br/>
            <?php echo PHONE; ?>
        </div>
        <div class="col-sm-6">
            <h4><?php echo $label; ?></h4>
            Total products: <?php echo $total_products; ?>
            <br/>
            <?php if (isset($total_products_under_this_category)) { ?>
                Total products under <?php echo $category_name; ?> : <?php echo $total_products_under_this_category; ?>
                <br/>
            <?php } ?>

            Total uncategorized products: <?php echo $total_uncategorized_products; ?>
        </div>

    </div>



    <div>



        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <td>Product</td>
                    <?php if ($this->input->get('seller_id')) { ?>
                        <td>Price</td>
                    <?php } else { ?>
                        <td class="noprint">Links</td>
                    <?php } ?>
                    <td>Brand</td>
                    <td>Category</td>
                    <td>Description</td>
                    <td>Stock</td>
                    <td class="noprint">Action</td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="product in products|filter:m">
                    <td>
                        <a href="<?php echo URL_X . 'Product/single_product/'; ?>{{product.id}}">
                            {{product.product_name}}
                        </a>
                    </td>
                    <?php if ($this->input->get('seller_id')) { ?>
                        <td>{{product.product_price}}</td>
                    <?php } else { ?>
                        <td class="noprint">
                            <a class="badge" 
                               style="background: #0063dc;"
                               href="<?php echo URL_X; ?>Inventory/add_new?product_id={{product.id}}">+ i</a>
                            <!--link to sellers who sell this product-->
                            <a class="badge" href="<?php echo URL_X; ?>Seller?product_id={{product.id}}">Sellers</a>
                            <!--link to inventories done for this product-->
                            <a class="badge" href="<?php echo URL_X; ?>Inventory?product_id={{product.id}}">Inventories</a>
                        </td>
                    <?php } ?>
                    <td> {{product.product_brand}}</td>
                    <?php // $product_category = $this->product_category_model->get_category_name($s->product_category);  ?>
                    <td> 
                        <a href="<?php echo URL_X . 'Product?product_category_id='; ?>{{product.product_category_id}}">
                            {{product.product_category}}
                        </a>
                    </td>
                    <td> {{product.product_description}}</td>
                    <td> <span class="badge">&nbsp;{{product.stock}}&nbsp;</span></td>
                    <td class="noprint">
                        <?php if (isset($detach_link)) { ?>
                            <a href="<?php echo $detach_link; ?>{{product.mapping_id}}" class="btn  btn-danger btn-xs">Detach</a>
                        <?php } else { ?>
                             <a href="<?php echo URL_X . 'Product/save_varient/'; ?>{{product.id}}" class="btn  btn-warning btn-xs">
                                 <span class="glyphicon glyphicon-random"></span>
                             </a>
                            <a href="<?php echo URL_X . 'Product/edit/'; ?>{{product.id}}" class="btn  btn-primary btn-xs">Edit</a>
                            <a href="<?php echo URL_X . 'Product/delete/'; ?>{{product.id}}" class="btn  btn-danger btn-xs">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.products = data;
                console.log(data);
            });

        }]);
</script>