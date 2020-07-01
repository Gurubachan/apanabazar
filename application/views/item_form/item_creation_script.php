<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function () {
		load_category('cboCategoryId',"<?=base_url()?>");
		load_manufacturer('cboBrandId',"<?=base_url()?>");
        load_taxrate('cboTaxRate',"<?=base_url()?>");
        load_item('cboItem',"<?=base_url()?>");
        load_productlist('cboProductId',"<?=base_url()?>");
        $('.nav-item.active').trigger('click');
	});
    $("#cboProductId").select2({
        placeholder: "Select a Product",
        allowClear: true,
        width: 'resolve',
        theme: "classic"
    });
	$('#frmItemCreation').submit(function (e) {
		e.preventDefault();
		submitform(this,'btnSubmit','txtid');
        //load_item_report('showReportItemList',"<?//=base_url()?>//");
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
                            htmldata+="<tr style='cursor: pointer' onclick='editRowItems("+data[i].id+","+data[i].isactive+")'><td style='width: 10px;' '>"+j+"</td><td>"+data[i].productid+"-"+data[i].product.productname+"</td><td>"+data[i].brandid+"-"+data[i].brand.brandname+"</td><td>"+data[i].itemname+"</td><td>"+itemcode+"</td><td>"+data[i].taxrate.taxratename+"</td></tr>";
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
            }
        });
    }
    $("#showtablereport").dataTable();
    let count=0;
    $("#txtItem").keyup(function () {
        let item = $("#txtItem").val();
        if(item!=""){
            $.ajax({
                type:'post',
                url:'<?=base_url("Item/fetch_item_details")?>',
                data:{itemname:item},
                dataType:'json',
                success:function (data) {
                    console.log(data);
                    if (data!=false) {
                        $("#searchTable").show();
                        var htmldata="";
                        var j=0;
                        for (var i in data){
                            j++;
                            let id = data[i].id;
                            let itemname = JSON.stringify(data[i].itemname);
                            htmldata+="<tr onclick='pickData("+id+","+itemname+")' style='cursor: pointer; z-index: 999; padding: 5px;'><td>"+data[i].itemname +"</td></tr>";
                        }
                        $(".loadItemSearchData").html(htmldata);
                    }
                }
            });
        }else{
            $(".searchTable").hide();
        }
    });
    itemsid=0;
    function pickData(itemid,itemname){
        $("#reportSpiner").show();
        $("#txtItem").val(itemname);
        $(".searchTable").hide();
        itemsid=itemid;
        $.ajax({
            type:'post',
            url:'<?=base_url("Itemvariant/checkItemDataAvailability")?>',
            //url:'<?//=base_url("Itemvariant/create_itemvariant")?>//',
            data:{itemid:itemid},
            dataType:'json',
            success:function (f) {
                var htmldata ="";
                    $.ajax({
                        type:'post',
                        url:'<?=base_url("Itemvariant/load_variant_page")?>',
                        success:function (f) {
                            $("#loadItemResponse").html(f);
                        }
                    });
                   }
        });
    }
    $('#frmItemVariantCreation').submit(function (e) {
        e.preventDefault();
        createNewVariant(this,'btnSubmit','txtid');
    });
    function createNewVariant(formid,btnid,txtid){
        $("#"+btnid).attr('disabled',true);
        var formData = new FormData(formid);
        formData.append('itemid', itemsid);
        $.ajax({
            type:'post',
            url:formid.action,
            data:formData,
            crossDomain:true,
            dataType:'json',
            processData: false,
            contentType: false,
            cache: false,
            success:function (data) {
                if(data!=false){
                    console.log(data);
                    var status="";
                    if(data.status==true){
                        mytoast(data);
                        $('#exampleModal').modal('hide');
                        // load_report();
                        //updateToCreate(btnid);
                        $("#"+formid.id).trigger('reset');
                    }else if(data.status==false){
                        mytoast(data);
                    }
                    $("#"+txtid).val(0);
                }
            },
            error : function(error){
                JSON.stringify(error);
                if(error.status == 500){
                    var str =  JSON.stringify(error.responseText);
                    var pos1 = str.indexOf("<p>",str.search("</p>"));
                    var pos = str.indexOf("</p>",pos1);
                    var res=[];
                    res['message']="Error";
                    res['data']=str.slice(pos1, pos);
                }else if( error.status == 404){
                    var str =  JSON.stringify(error.responseText);
                    var pos1 = str.search("<p>");
                    var pos = str.search("</p>");
                    var res=[];
                    res['message']="Error";
                    res['data']=str.slice(pos1, pos);
                }
                mytoast(res);
            }
        });
        $("#"+btnid).attr('disabled',false);
    }
    $("#cboProductId").change(function (){
        var pid = $("#cboProductId").val();
        $.ajax({
            type:'post',
            url:'<?=base_url("ProductVariantMap/load_variant")?>',
            data:{productid:pid},
            dataType:'json',
            success:function (f) {
                if(f.status != false){
                   var htmldata="";
                   var i=0;
                   for(var j in f){
                       htmldata +="<div>"+(i+1)+". "+f[j].variant.variantname+"</div>";
                       i++;
                   }
                    $("#showProductMap").html(htmldata);
                }
            }

        });
    })
</script>

