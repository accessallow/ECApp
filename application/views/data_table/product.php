<table 
    class="table table-hover table-striped table-bordered"
    id="mytable">

    <thead>
        <tr>
            <td>Product</td>
            <td>Brand</td>
            <td>Category</td>
            <td>Description</td>
            <td>Stock</td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td>Product</td>
            <td>Brand</td>
            <td>Category</td>
            <td>Description</td>
            <td>Stock</td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach($products as $p){?>
        <tr>
            <td><?php echo $p->product_name; ?></td>
            <td><?php echo $p->product_brand; ?></td>
            <td><?php echo $p->product_category; ?></td>
            <td><?php echo $p->stock; ?></td>
            <td><?php echo $p->product_description; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<div class="row">
    <input type="text" list="names"/>
    <datalist id="names">
        <option value="Adam">
        <option value="Alice">
        <option value="Abraham">
        <option value="Bucky">
    </datalist>
</div>

<script>
    var app = angular.module('myapp', []);
    app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {

           

        }]);
</script>