<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <td colspan="4">
                Form : <?php echo $form->shop_name; ?> ---
                <?php echo $form->product; ?>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Shop name</td>
            <td><?php echo $form->shop_name; ?></td>
            <td>Product name</td>
            <td><?php echo $form->product; ?></td>
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
            <td><?php echo $form->description; ?></td>
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
                    href="<?php echo $form_edit_link ?>"
                    class="btn btn-xs btn-danger">
                    Delete
                </a>
            </td>

        </tr>
    </tbody>
</table>