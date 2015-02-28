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
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Files attached with <?php echo $product_name; ?>
            <span class="pull-right">
                <a href="<?php echo $upload_new_link; ?>" class="btn btn-success btn-xs">Upload file</a>
            </span>
        </div>
        <div class="panel-body" ng-controller="UploadController">
            
            <div 
                ng-repeat="upload in uploads"
                class="col-md-2" style="text-align: center;margin-bottom: 15px;">
                <img ng-src="<?php echo $upload_base;?>/{{upload.file_name}}" 
                     class="img-thumbnail"
                     style="width: 150px;height:100px;margin-bottom: 5px;"
                     />
                <br/>
                <a 
                    href="<?php 
                    echo site_url('FileUpload/single'); ?>/{{upload.id}}/{{upload.attachment_type}}/{{upload.attachment_id}}" 
                    class="btn btn-info btn-xs"
                    style="margin-top:-190px;margin-left:110px;"
                    >V</a>
                
                <a href="<?php 
                    echo site_url('FileUpload/delete'); ?>/{{upload.id}}/{{upload.attachment_type}}/{{upload.attachment_id}}" class="btn btn-danger btn-xs"
                    style="margin-top:-138px;margin-left:-24px;"
                    >D</a>        
                    
            </div>
            
            
        </div>
    </div>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('UploadController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $uploads_json_fetch_link; ?>').success(function (data) {
                $scope.uploads = data;
                console.log(data);
            });

        }]);
</script>
