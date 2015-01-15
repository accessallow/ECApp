</div> <!-- closing the container opened in header -->       

<script src="<?php echo URL; ?>assets/bootstrap3/jquery-2.1.1.min.js"></script>
<script src="<?php echo URL; ?>assets/bootstrap3/js/bootstrap.min.js"></script>
<script src="<?php echo URL;?>assets/bootstrap3/parsley.js"></script>
<script src="<?php echo URL;?>assets/bootstrap3/js/moment.min.js"></script>
<script src="<?php echo URL;?>assets/bootstrap3/js/bootstrap-datetimepicker.min.js"></script>

<script>
     $(document).ready(function() {
                        
                $('form').parsley();
                
                    $('#datetimepicker1').datetimepicker({pickDate: true,pickTime:false});
               

            });
            
</script>
</body>
</html>