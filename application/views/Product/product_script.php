<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        load_category('cboCategory',"<?=base_url()?>");
    });
    $('#frmProduct').submit(function (e) {
        e.preventDefault();
        submitform(this,'btnSubmit','txtid');
    });
    $('#cboCategory').change(function (e) {
        var categoryid=$('#cboCategory').val();
        load_subcategory('cboSubcategory',categoryid,"<?=base_url()?>")
    });
    $('#cboSubcategory').change(function (e) {
		load_report();
    });
    function load_report() {
    	var subcatid=$('#cboSubcategory').val();
    	if(subcatid!=""){
			$.ajax({
				type:'post',
				url:"<?=base_url('Product/report_product')?>",
				dataType:'json',
				success :function (data) {
					if(data.status!=false){
						var htmldata="";
						var count=1;
						for (var i in data.data) {
							htmldata +="<tr>"+
								"<td>"+count+"</td>"+
								"<td>"+data.data[i].subcatid+"</td>"+
								"<td>"+data.data[i].productname+"</td>"+
								"<td>"+data.data[i].hsncode+"</td>"+
								"<td><img src='<?=base_url("assets/images/Product/")?>"+data.data[i].productimage+"' alt='no logo uploaded' height='100' width='100'></td>"+
								"<td>"+data.data[i].description+"</td>"+
								"<td class='text-center' id='action"+data.data[i].id+"'>" ;
							if (data.data[i].isactive==1){
								htmldata +="<i id='activeInactive"+data.data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data.data[i].id+",1)'></i>"+"</td></tr>";
							}else if (data.data[i].isactive==0){
								htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+data.data[i].id+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
							}
							count++;
						}
						jQuery("#showReportproduct").html(htmldata);
					}
				}
			})
		}
    }
    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Product/isactive_product')?>");
    }
</script>
