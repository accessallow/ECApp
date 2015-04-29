</div> <!-- closing the container opened in header -->       


<script src="<?php echo URL; ?>assets/bootstrap3/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>assets/parsley/parsley.js"></script>
<script src="<?php echo URL; ?>assets/bootstrap3/js/moment.min.js"></script>
<script src="<?php echo URL; ?>assets/bootstrap3/js/bootstrap-datetimepicker.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="<?php echo URL; ?>assets/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>


<script>
    $(document).ready(function () {

        $('form').parsley();

        $('#datetimepicker1').datetimepicker({pickDate: true, pickTime: false});
        $('#mytable').DataTable({
            "lengthMenu": [[10, 25, 50,100,1000, -1], [10, 25, 50,100,1000, "All"]]
        });


    });

</script>
</body>
</html>