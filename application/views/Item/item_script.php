<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function () {
		load_category('cboCategory',"<?=base_url()?>");
		load_manufacturer('cboBrandId',"<?=base_url()?>");
		load_vendor('CboVendorId',"<?=base_url()?>");
	});
	$('#frmItem').submit(function (e) {
		e.preventDefault();
		submitform(this,'btnSubmit','txtid');
	});
	$('#cboCategory').change(function (e) {
		var categoryid=$('#cboCategory').val();
		load_subcategory('cboSubcategory',categoryid,"<?=base_url()?>")
	});
	$('#cboSubcategory').change(function (e) {
		var subcatid=$('#cboSubcategory').val();
		load_product('cboProductId',subcatid,"<?=base_url()?>");
	});
	$('#cboBrandId').change(function (e) {
		var productid=$('#cboProductId').val();
		var vendorid=$('#CboVendorId').val();
		var brandid=$('#cboBrandId').val();
		load_item('cboitem',productid,vendorid,brandid,"<?=base_url()?>");
	});
	$('#CboVendorId').change(function (e) {
		var productid=$('#cboProductId').val();
		var vendorid=$('#CboVendorId').val();
		var brandid=$('#cboBrandId').val();
		load_item('cboitem',productid,vendorid,brandid,"<?=base_url()?>");
	});
	$('#cboProductId').change(function (e) {
		var productid=$('#cboProductId').val();
		var vendorid=$('#CboVendorId').val();
		var brandid=$('#cboBrandId').val();
		load_item('cboitem',productid,vendorid,brandid,"<?=base_url()?>");
	});
	function load_report() {
		console.log('No report loaded.');
	}
	function active_inactive(rowid,isactive) {
		active_inactive_records(rowid,isactive,"<?=base_url('Product/isactive_product')?>");
	}
</script>
