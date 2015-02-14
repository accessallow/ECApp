

<div class="row noprint">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" ng-model="s"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo $add_link; ?>">
            <?php echo $addButtonLabel; ?>
        </a>
    </div>
</div>



<div ng-controller="SellerController">
    <div class="row well noprint">
        <h4><?php echo $label; ?>
            <?php if ($this->input->get('product_id')) { ?>
                <a class="badge" href="<?php echo URL_X; ?>Seller/">Get all</a>
            <?php } ?>
        </h4>
        <p>
            <span class="badge">Total sellers : {{sellers.length}}</span>

<!--            <span class="badge">Total sellers : <?php echo $total_sellers_alive; ?></span>-->

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
            Total sellers : {{sellers.length}} 
        </div>

    </div>
    <table class="table table-hover table-striped table-bordered" style="font-size: 0.9em;">
        <thead>
            <tr>
                <td>Seller</td>
                <?php if ($this->input->get('product_id')) { ?>
                    <td>Price</td>
                <?php } else { ?>

                    <td class="noprint">Links</td>
                <?php } ?>
                <td>Phone</td>
                <td>Email</td>
                <td>Tin no.</td>
                <td>Address</td>
                <td class="noprint">Actions</td>
            </tr>
        </thead>

        <tbody>
            <tr ng-repeat="seller in sellers|filter:s">
                <td>

                    {{seller.seller_name}}

                </td>
                <?php if ($this->input->get('product_id')) { ?>
                    <td>{{seller.product_price}}</td>
                <?php } else { ?>
                    <td class="noprint">
                        <a href="<?php echo URL_X; ?>Inventory?seller_id={{seller.id}}" class="badge">
                            Inventories
                        </a>
                        <a href="<?php echo URL_X; ?>Product?seller_id={{seller.id}}" class="badge">
                            Products
                        </a>
                    </td>
                <?php } ?>
                <td>{{seller.seller_phone_number}}</td>
                <td>{{seller.mail_id}}</td>
                <td>{{seller.tin_number}}</td>
                <td>{{seller.seller_address}}</td>
                <td class="noprint">
                    <?php if (isset($edit_link)) { ?>
                        <a href="<?php echo $edit_link; ?>{{seller.id}}" class="btn  btn-primary btn-xs">Edit</a>

                        <a href="<?php echo $delete_link; ?>{{seller.id}}" class="btn  btn-danger btn-xs">Delete</a>
                    <?php } else { ?>
                        <a href="<?php echo $delete_link; ?>{{seller.mapping_id}}" class="btn  btn-danger btn-xs">Detach</a>
                    <?php } ?>
                </td>
            </tr>
        </tbody>


    </table>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('SellerController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $fetch_json_link; ?>').success(function (data) {
                $scope.sellers = data;
                console.log(data);
            });
        }]);
</script>