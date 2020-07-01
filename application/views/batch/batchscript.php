<script type="text/javascript">
    $(function () {
        load_report();
    });
    $('#btnSubmit').click(function(e){
        e.preventDefault();
        var frm = $("#frmBatch,#frmPermissions").serialize();
        $.ajax({
            type:"post",
            url:"<?=base_url('Batch/create_batch')?>",
            data:frm,
            success:function(res){
                if (res!=false) {
                    return true;
                }
            }
        });
    });
    function load_report() {
        $.ajax({
            type:'post',
            url:"<?=base_url('Batch/report_batch')?>",
            dataType:'json',
            success :function (data) {
                if (data.status!=false){
                    var htmldata="";
                    var count=1;
                    for (var i in data.data) {
                        htmldata +="<tr>"+
                            "<td>"+count+"</td>"+
                            "<td>"+data.data[i].itemid+"</td>"+
                            "<td>"+data.data[i].uniquecode+"</td>"+
                            "<td>"+data.data[i].quantity+"</td>"+
                            "<td>"+data.data[i].mrp+"</td>"+
                            "<td>"+data.data[i].manfactdate+"</td>"+
                            "<td>"+data.data[i].expdate+"</td>"+
                            "<td>"+data.data[i].outstock+"</td>"+
                            "<td>"+data.data[i].remainstock+"</td>"+
                            "<td class='text-center' id='action"+data.data[i].id+"'>" ;
                        if (data.data[i].isactive==1){
                            htmldata +="<i id='activeInactive"+data.data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data.data[i].id+",1)'></i>"+"</td></tr>";
                        }else if (data.data[i].isactive==0){
                            htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+data.data[i].id+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
                        }
                        count++;
                    }
                    jQuery("#showReportItem").html(htmldata);
                }
            }
        })
    }


    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Batch/isactive_batch')?>");
    }
</script>