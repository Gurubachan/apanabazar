<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        load_category('cboCategoryId',"<?=base_url()?>");
        load_manufacturer('cboBrandId',"<?=base_url()?>");
        load_unit('CboUnitId',"<?=base_url()?>");
        load_taxrate('cboTaxRate',"<?=base_url()?>");
    });
    $('#frmItemCreation').submit(function (e) {
        e.preventDefault();
        submitform(this,'btnSubmit','txtid');
        //load_item_report('showReportItemList',"<?//=base_url()?>//");
    });
    $('#cboCategoryId').change(function (e) {
        var categoryid=$('#cboCategoryId').val();
        load_subcategory('cboSubcategoryId',categoryid,"<?=base_url()?>")
    });
    $('#cboSubcategoryId').change(function (e) {
        var subcatid=$('#cboSubcategoryId').val();
        load_product('cboProductId',subcatid,"<?=base_url()?>");
    });
    $('#btnReport').click(function () {
        load_item_report('showReportItemList',"<?=base_url()?>");
    });
    function load_item_report(id,path) {
        $("#itemReportHeader").show();
        $("#spinerview").show();
        $.ajax({
            type:'post',
            url:path+'/Item/report_item_data',
            dataType:'json',
            success:function (data) {
                console.log(data);
                if (data!=false) {
                    $("#spinerview").hide();
                    var htmldata="";
                    var j=0;
                    let itemcode;
                    let itemimage;
                    for (var i in data){
                        j++;
                        if(data[i].itemcode!= null){
                            itemcode=data[i].itemcode;
                        }else{
                            itemcode="";
                        }
                        if(data[i].itemimage != null){
                            itemimage = "<img src='<?=base_url("assets/thumbnails/")?>"+data[i].itemimage+"80X80.jpg' height='40' width='40'>";
                        }else{
                            itemimage="";
                        }
                        htmldata+="<tr style='cursor: pointer' onclick='editRowItems("+data[i].id+","+data[i].isactive+")'><td style='width: 10px;' '>"+j+"</td><td>"+data[i].productid+"-"+data[i].product.productname+"</td><td>"+data[i].brandid+"-"+data[i].brand.brandname+"</td><td>"+itemcode+" &nbsp; "+data[i].itemname+" <span class='f-right'> "+itemimage+"</span></td><td>"+data[i].mrp+"</td><td>"+data[i].taxrate+"</td><td>"+data[i].unitid+"-"+data[i].unit.unitname+"</td><td>"+data[i].quantity+"</td><td>"+data[i].dimension+"</td></tr>";
                    }
                    $("#"+id).html(htmldata);
                }
            }
        })
    }
    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Product/isactive_product')?>");
    }
    function editRowItems(id,isactive) {
        console.log(id);
        console.log(isactive);
        $.ajax({
            type:'post',
            url:'<?=base_url("Item/edit_item")?>',
            data:{id:rowid,isactive:isactive},
            success:function (data) {
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
                // $("#").data[0].;
            }
        });
    }
    $("#showtablereport").dataTable();



</script>


