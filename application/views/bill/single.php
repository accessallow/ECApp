<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="<?php echo site_url('Bill/dashboard'); ?>" class="btn btn-xs btn-warning">
                <span class="glyphicon glyphicon-backward"></span> Back
            </a>
            Files attached with this bill <?php // echo $product_name; ?>
            <span class="pull-right">
                <a href="<?php echo $upload_new_link; ?>" class="btn btn-success btn-xs">Upload file</a>
            </span>
        </div>
        <div class="panel-body" ng-controller="UploadController">

            <div 
                ng-repeat="upload in uploads"
                class="col-md-2" style="text-align: center;margin-bottom: 15px;">
                <img ng-src="<?php echo $upload_base; ?>/{{upload.file_name}}" 
                     class="img-thumbnail"
                     style="width: 150px;height:100px;margin-bottom: 5px;"
                     />
                <br/>
                <a 
                    href="<?php echo site_url('FileUpload/single'); ?>/{{upload.id}}/{{upload.attachment_type}}/{{upload.attachment_id}}" 
                    class="btn btn-info btn-xs"
                    style="margin-top:-190px;margin-left:110px;"
                    >V</a>

                <a href="<?php echo site_url('FileUpload/delete'); ?>/{{upload.id}}/{{upload.attachment_type}}/{{upload.attachment_id}}" class="btn btn-danger btn-xs"
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
