<?php if($this->session->flashdata('message')){ ?>
<div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok"></span>
    <strong><?php echo $this->session->flashdata('message');?></strong>
</div>
<?php } ?>

<div class="row">
    <div class="col-md-7">
        <form class="form-inline">
            <div class="form-group">
                <input  placeholder="Search..."  type="text" ng-model="m" class="form-control noprint"/>
            </div>
        </form>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <a class="btn btn-success btn-xs" href="<?php echo URL_X . 'Product_category/add_new'; ?>">Add new category</a>
    </div>
</div>
<br/>

<div class="row" ng-controller="CategoryController">
    <div class="col-md-5">
        <table class="table table-hover table-striped">

            <tr ng-repeat="category in categories|filter:m">
                <td>
                    <a href="<?php echo URL_X; ?>Product?product_category_id={{category.id}}">
                        {{category.product_category_name}}
                    </a>
                </td>

                <td style="text-align: right;">
                    <a href="<?php echo URL_X . 'Product_category/edit/'; ?>{{category.id}}" class="btn  btn-primary btn-xs">Edit</a>
                    <a href="<?php echo URL_X . 'Product_category/delete/'; ?>{{category.id}}" class="btn  btn-danger btn-xs">Delete</a>
                </td>
            </tr>

        </table>
    </div>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('CategoryController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.categories = data;
                console.log("Categories = \n" + data);
            });

        }]);
</script>