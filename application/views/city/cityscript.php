<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    $(function () {
        load_report();
		load_state('cboState',"<?=base_url()?>");
    });
    $('#frmCity').submit(function (e) {
        e.preventDefault();
        submitform(this,'btnSubmit','txtid');
    });
    $('#cboState').change(function () {
    	var stateid=$('#cboState').val();
		load_district('cboDistrict',stateid,"<?=base_url()?>");
    });
    function load_report() {
        $.ajax({
            type:'post',
            url:"<?=base_url('City/report_city')?>",
            dataType:'json',
            success :function (data) {
                if (data.status!=false){
                    var htmldata="";
                    var count=1;
                    for (var i in data.data) {
                        htmldata +="<tr>"+
                            "<td>"+count+"</td>"+
                            "<td>"+data.data[i].districtid+"</td>"+
                            "<td>"+data.data[i].code+"</td>"+
                            "<td>"+data.data[i].name+"</td>"+
                            "<td class='text-center' id='action"+data.data[i].id+"'>" ;
                        if (data.data[i].isactive==1){
                            htmldata +="<i id='activeInactive"+data.data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data.data[i].id+",1)'></i>"+"</td></tr>";
                        }else if (data.data[i].isactive==0){
                            htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+data.data[i].id+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
                        }
                        count++;
                    }
                    jQuery("#showReportCity").html(htmldata);
                }
            }
        })
    }
    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('City/isactive_city')?>");
    }
</script>
