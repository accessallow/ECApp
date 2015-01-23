

<div class="row">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" ng-model="s"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Seller/add_new'; ?>">
            <?php echo $buttonLabel; ?>
        </a>
    </div>
</div>



<div ng-controller="SellerController">
    <div class="row well">
        <h4><?php echo $label; ?>
            <?php if($this->input->get('product_id')){ ?>
            <a class="badge" href="<?php echo URL_X;?>Seller/">Get all</a>
            <?php } ?>
        </h4>
        <p>
            <span class="badge">Total sellers : {{sellers.length}}</span>
            
<!--            <span class="badge">Total sellers : <?php echo $total_sellers_alive; ?></span>-->
            
        </p>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td>Seller</td>
                <?php if($this->input->get('product_id')){?>
                <td>Price</td>
                <?php }else{ ?>
                
                <td>Links</td>
                <?php } ?>
                <td>Phone</td>
                <td>Address</td>
                <td>Actions</td>
            </tr>
        </thead>

        <tbody>
            <tr ng-repeat="seller in sellers|filter:s">
                <td>
                    
                        {{seller.seller_name}}
                    
                </td>
                <?php if($this->input->get('product_id')){?>
                <td>{{seller.product_price}}</td>
                <?php }else{ ?>
                <td>
                    <a href="<?php echo URL_X;?>Inventory?seller_id={{seller.id}}" class="badge">
                        Inventories
                    </a>
                    <a href="<?php echo URL_X;?>Product?seller_id={{seller.id}}" class="badge">
                        Products
                    </a>
                </td>
                <?php } ?>
                <td>{{seller.seller_phone_number}}</td>
                <td>{{seller.seller_address}}</td>
                <td>
                    <a href="<?php echo URL_X . 'Seller/edit/'; ?>{{seller.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Seller/delete/'; ?>{{seller.id}}" class="btn  btn-danger btn-xs">Delete</a>
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