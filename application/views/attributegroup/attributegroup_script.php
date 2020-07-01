<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    $(function () {
        load_report();
    });
    jQuery(document).ready(function () {
        load_category('cboCategory',"<?=base_url()?>");
    });
    $('#frmAttributegroup').submit(function (e) {
        e.preventDefault();
        submitform(this,'btnSubmit','txtid');
    });
    jQuery('#cboCategory').change(function (e) {
        var categoryid=$('#cboCategory').val();
        load_subcategory('cboSubcategory',categoryid,"<?=base_url()?>")
    });
    jQuery('#cboSubcategory').change(function (e) {
        var subcategoryid=$('#cboSubcategory').val();
        load_product('cboProduct',subcategoryid,"<?=base_url()?>")
    });
    function load_report() {
        $.ajax({
            type:'post',
            url:"<?=base_url('Attributegroup/report_attributegroup')?>",
            dataType:'json',
            success :function (data) {
                if (data.status!=false){
                    var htmldata="";
                    var count=1;
                    for (var i in data.data) {
                        htmldata +="<tr>"+
                            "<td>"+count+"</td>"+
                            "<td>"+data.data[i].attributegroupname+"</td>"+
                            "<td>"+data.data[i].description+"</td>"+
                            "<td>"+data.data[i].product+"</td>"+
                            "<td class='text-center' id='action"+data.data[i].id+"'>" ;
                        if (data.data[i].isactive==1){
                            htmldata +="<i id='activeInactive"+data.data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data.data[i].id+",1)'></i>"+"</td></tr>";
                        }else if (data.data[i].isactive==0){
                            htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+data.data[i].id+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
                        }
                        count++;
                    }
                    jQuery("#showReportattgrp").html(htmldata);
                }
            }
        })
    }
    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Attributegroup/isactive_attributegroup')?>");
    }
</script>
