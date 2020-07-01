<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        load_vendor_flag('cboflagId',"<?=base_url()?>");
        load_vendor_type('inputVendorType',"<?=base_url()?>");
        load_state('inputState',"<?=base_url()?>");
		$('#frmVendorRegister').submit(function (e) {
			e.preventDefault();
            let p = $("#txtPassword").val();
            let rp = $("#txtReEnterPassword").val();
            if(p == rp){
                submitform(this,'btnSubmit','txtid');
                $('#p_error').hide();
            }else{
                $('#p_error').show();
            }
            // submitform(this,'btnSubmit','txtid');
		});
		$('#inputState').change(function () {
			var stateid=$('#inputState').val();
			load_district('inputDistrict',stateid,"<?=base_url()?>");
		});
		$('#inputDistrict').change(function () {
			var distid=$('#inputDistrict').val();
			load_city('inputCity',distid,"<?=base_url()?>");
		});
    });
// function passwordCheck(){
//
// }

    </script>
