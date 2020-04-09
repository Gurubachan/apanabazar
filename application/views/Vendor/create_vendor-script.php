<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        load_vendor_flag('cboflagId',"<?=base_url()?>");
    });
    $('#btnSubmit').click(function(e){
        e.preventDefault();
        var frm = $("#frmVendorRegister,#frmPermissions").serialize();
        $.ajax({
            type:"post",
            url:"<?=base_url('VendorRegistration/create_vendor')?>",
            data:frm,
            success:function(res){
                if (res!=false) {
                  return true;
                }
            }
        });
    });
    </script>