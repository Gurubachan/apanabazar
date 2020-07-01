<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script>
    $(function () {
        $("#txtItem").focus();
    });

    $("#txtItem").keyup(function () {
        let item = $("#txtItem").val();
        if(item!=""){
            $.ajax({
                type:'post',
                url:'<?=base_url("Inventory/fetch_item_details")?>',
                data:{itemname:item},
                dataType:'json',
                success:function (data) {
                    // console.log(data);
                    if (data!=false) {
                        $("#searchTable").show();
                        var htmldata="";
                        var j=0;
                        for (var i in data){
                            j++;
                           let id = data[i].id;
                           let itemname = JSON.stringify(data[i].itemname);
                            htmldata+="<tr onclick='collectData("+id+","+itemname+")' style='cursor: pointer; z-index: 999; padding: 5px;'><td>"+data[i].itemname +"</td></tr>";
                        }
                        $("#loadSearchData").html(htmldata);
                    }else{
                        $("#loadSearchData").html("Item Not Found");
                    }
                }
            });
        }else{
            $("#searchTable").hide();
        }
    });
    itemsid=0;
    textid=0;
    function collectData(itemid,itemname){
        $("#reportSpiner").show();
        $("#txtItem").val(itemname);
        $("#searchTable").hide();
        itemsid=itemid;
        $.ajax({
            type:'post',
            url:'<?=base_url("Inventory/fetch_item_from_itmevariant")?>',
            data:{itemid:itemid},
            success:function (data) {
               if(data){
                   $("#load_inventory_form").html(data);
               }
            }
        });
    }
    function editRow(itemid){
           $(".showtextbox").show();
           $(".tag").hide();
        textid=itemid;
    }
    function cancelUpdate(){
           $(".showtextbox").hide();
           $(".tag").show();
    }
    $('#btnReport').click(function () {
        load_report('showReportInventoryList',"<?=base_url()?>");
    });
	function load_report(id,path) {
        $.ajax({
            type:'post',
            url:path+'/Inventory/report_inventory_data',
            dataType:'json',
            success:function (data) {
                if (data!=false) {
                    var htmldata="";
                    var j=0;
                    for (var i in data){
                        j++;
                        htmldata+="<tr><td>"+j+"</td><td>"+data[i].itemid+"</td><td>"+data[i].vendorid+"</td><td>"+data[i].saleprice+"</td><td>"+data[i].discount+"</td><td>"+data[i].openingstock+"</td><td>"+data[i].inwardstock+"</td><td>"+data[i].outwardstock+"</td><td>"+data[i].trackby+"</td></tr>";
                    }
                    $("#"+id).html(htmldata);
                }
                console.log(data);
            }
        })
	}
	function active_inactive(rowid,isactive) {
		active_inactive_records(rowid,isactive,"<?=base_url('Product/isactive_product')?>");
	}
    //var vendorid =<?//=$this->session->adminLogin['userid']?>//;

</script>

