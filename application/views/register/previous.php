<?php
$json_fetch_link = site_url('Activation/index_json');
?>
<div class="row" ng-controller="ActivationController">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <td>Id</td>
                <td>Product code</td>
                <td>Key</td>
                <td>Activator</td>
                <td>Activated</td>
                <td>Usage left</td>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="activation in activations">
                <td>{{activation.id}}</td>
                <td>{{activation.p_c}}</td>
                <td>{{activation.a_k}}</td>
                <td>{{activation.a_n}}</td>
                <td>{{activation.a_t}}</td>
                <td>{{activation.a_c}}</td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = angular.module('myapp', []);
    app.controller('ActivationController', ['$scope', '$http', function ($scope, $http) {
            $http.get('<?php echo $json_fetch_link; ?>').success(function (data) {
                $scope.activations = data;
                console.log(data);
            });

        }]);
</script>

