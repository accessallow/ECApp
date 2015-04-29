<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <td colspan="4">
                <a href="<?php echo site_url('Form49'); ?>" class="btn btn-xs btn-warning">
                    <span class="glyphicon glyphicon-backward"></span> Back
                </a>
                Form : <?php echo $form->shop_name; ?> ---
                <?php //echo $form->product; ?>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Shop name</td>
            <td><?php echo $form->shop_name; ?></td>
            <td>Product name</td>
            <td><?php //echo $form->product;  ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?php echo $form->address; ?></td>
            <td>Category</td>
            <td><?php echo $form->category; ?></td>
        </tr>
        <tr>
            <td>Tin number</td>
            <td><?php echo $form->tin_number; ?></td>
            <td>Description</td>
            <td><?php //echo $form->description;  ?></td>
        </tr>
        <tr>
            <td>Invoice number</td>
            <td><?php echo $form->invoice_number; ?></td>
            <td>Transport value</td>
            <td><?php echo $form->transport_value; ?></td>
        </tr>
        <tr>
            <td>Total value</td>
            <td><?php echo $form->total_value; ?></td>
            <td>Billty number</td>
            <td><?php echo $form->billty_number; ?></td>
        </tr>
        <tr>
            <td>Total quantity</td>
            <td><?php echo $form->total_quantity; ?></td>
            <td>Vehicle number</td>
            <td><?php echo $form->vehicle_number; ?></td>
        </tr>
        <tr>
            <td>Dispatch location</td>
            <td><?php echo $form->dispatch_location; ?></td>
            <td>Form "C"</td>
            <td><?php echo $form->form_c; ?></td>
        </tr>
        <tr>
            <td>Destination</td>
            <td><?php echo $form->destination; ?></td>
            <td>Date</td>
            <td><?php echo $form->date; ?></td>
        </tr>
        <tr>

            <td colspan="4"class="noprint">
                <a 
                    href="<?php echo $form_edit_link ?>"
                    class="btn btn-xs btn-primary">
                    Edit
                </a>
                <a 
                    href="<?php echo $form_delete_link ?>"
                    class="btn btn-xs btn-danger">
                    Delete
                </a>
            </td>

        </tr>
    </tbody>
</table>

<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Files attached with Form : <?php echo $form->shop_name; ?> --- Form id:<?php echo $form->id; ?>
            <?php //echo $form->product; ?>
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
