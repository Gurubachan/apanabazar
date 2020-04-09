<script type="text/javascript">
    $(function () {
        load_report();
    });
    $('#frmCompany').submit(function (e) {
        e.preventDefault();
        submitform(this,'btnSubmit','txtid');
    });
    function load_report() {
        $.ajax({
            type:'post',
            url:"<?=base_url('Company/report_company')?>",
            dataType:'json',
            success :function (data) {
                if (data.status!=false){
                    var htmldata="";
                    var count=1;
                    for (var i in data.data) {
                        htmldata +="<tr>"+
                            "<td>"+count+"</td>"+
                            "<td>"+data.data[i].name+"</td>"+
                            "<td>"+data.data[i].pannumber+"</td>"+
                            "<td>"+data.data[i].gstnumber+"</td>"+
                            "<td><img src='<?=base_url("assets/images/photo/")?>"+data.data[i].logo+"' alt='no logo uploaded' height='100' width='100'></td>"+
                            "<td>"+data.data[i].address+"</td>"+
                            "<td class='text-center' id='action"+data.data[i].id+"'>" ;
                        if (data.data[i].isactive==1){
                            htmldata +="<i id='activeInactive"+data.data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data.data[i].id+",1)'></i>"+"</td></tr>";
                        }else if (data.data[i].isactive==0){
                            htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+data.data[i].id+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
                        }
                        count++;
                    }
                    jQuery("#showReportCompany").html(htmldata);
                }
            }
        })
    }


    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Company/isactive_company')?>");
    }
</script>