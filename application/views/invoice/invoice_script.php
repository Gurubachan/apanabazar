<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    $(function () {
        load_report();
    });
    $('#frmunit').submit(function (e) {
        e.preventDefault();
        submitform(this,'btnSubmit','txtid');
    });
    function load_report() {
        $.ajax({
            type:'post',
            url:"<?=base_url('Sales/report_orderlist')?>",
            dataType:'json',
            success :function (data) {
                console.log(data);
                if (data!=false){
                    var htmldata="";
                    var count=1;
                    for (var i in data) {
                        var vendorid = data[i].inventory.vendorid;
                        var vendorname = data[i].inventory.vendorname;
                        var usertype = "<?=$this->session->adminLogin['usertype']?>";
                        var images="<img src='<?=base_url("assets/images/ItemImage/")?>"+data[i].inventory.image+".jpg' height='50' width='50'>";
                     if(usertype == "Vendor" && vendorid == <?=$this->session->adminLogin['userid']?>){
                         htmldata +="<tr>"+
                             "<td>"+count+"</td>"+
                             "<td>"+data[i].created_at+"</td>"+
                             "<td>"+data[i].userid+"</td>"+
                             "<td>"+data[i].inventoryid+"</td>"+
                             "<td>"+data[i].inventory.productname+"</td>"+
                             "<td>"+data[i].inventory.itemname+"</td>"+
                             "<td>"+data[i].inventory.manufacturer+"</td>"+
                             "<td>"+data[i].inventory.quantity+"</td>"+
                             "<td>"+data[i].inventory.mrp+"</td>"+
                             "<td>"+data[i].inventory.saleprice+"</td>"+
                             "<td>"+data[i].noofitems+"</td>"+
                             "<td>"+images+"</td>"+
                             "<td colspan='2' style='width: 100px;'><button type='button' title='Approve' class='btn btn-xs btn-primary pull-left' onclick='order_approve("+data[i].id+")'><i class='fa fa-check'></i></button>&nbsp;<button type='button' title='Cancel' class='btn btn-xs btn-danger pull-right'><i class='fa fa-times'></i></button></td>"+
                             "<tr>" ;
                     }else if(usertype == "Admin"){
                         htmldata +="<tr>"+
                             "<td>"+count+"</td>"+
                             "<td>"+data[i].created_at+"</td>"+
                             "<td>"+data[i].userid+"</td>"+
                             "<td>"+vendorid+"-"+vendorname+"</td>"+
                             "<td>"+data[i].inventoryid+"</td>"+
                             "<td>"+data[i].inventory.productname+"</td>"+
                             "<td>"+data[i].inventory.itemname+"</td>"+
                             "<td>"+data[i].inventory.manufacturer+"</td>"+
                             "<td>"+data[i].inventory.quantity+"</td>"+
                             "<td>"+data[i].inventory.mrp+"</td>"+
                             "<td>"+data[i].inventory.saleprice+"</td>"+
                             "<td>"+data[i].noofitems+"</td>"+
                             "<td>"+images+"</td>"+
                             // "<td colspan='2' style='width: 100px;'><button type='button' title='Approve' id='btnApprove"+data[i].id+"' class='btn btn-xs btn-primary pull-left' onclick='order_approve("+data[i].id+")'><i class='fa fa-check'></i></button>&nbsp;<button type='button' title='Cancel' class='btn btn-xs btn-danger pull-right'><i class='fa fa-times'></i></button></td>"+
                             "<td colspan='2' style='width: 100px;'><span id='showInvoice"+data[i].id+"'></span><button type='button' title='Approve' id='btnApprove"+data[i].id+"' class='btn btn-xs btn-primary pull-left' onclick='order_approve("+data[i].id+")'>Approve</button>&nbsp;<button type='button' title='Cancel' class='btn btn-xs btn-danger pull-right mt-1'>Cancel</button></td>"+
                             "<tr>" ;
                     }
                        // if (data.data[i].isactive==1){
                        //     htmldata +="<i id='activeInactive"+data.data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data.data[i].id+",1)'></i>"+"</td></tr>";
                        // }else if (data.data[i].isactive==0){
                        // }
                        count++;
                    }
                    jQuery("#order_list_details").html(htmldata);
                }
            }
        })
    }
    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Unit/isactive_unit')?>");
    }
    function order_approve(id) {
        var btnApprove = $("#btnApprove"+id).html();
        if(btnApprove == "Approve"){
            $("#btnApprove"+id).hide();
            $("#showInvoice"+id).html("<button type='button' class='btn btn-xs btn-success' onclick='invoiceGenerate("+id+")' data-toggle=\"modal\" data-original-title=\"test\" data-target=\"#invoiceModal\">Invoice</button>");
        }
    }
    function invoiceGenerate(id) {
        $.ajax({
            type: 'post',
            url: "<?=base_url('Sales/invoice_generate/')?>"+id,
            // dataType: 'json',
            success: function (data) {
                // console.log(data);
                $("#load_invoice").html(data);
            }
        });
    }
</script>
