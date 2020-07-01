<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script src="<?=base_url('assets/js/load_function.js')?>"></script>
<script type="text/javascript">
    $(function () {
        load_attributegroup('cboAttributegroup',"<?=base_url()?>");
        load_variant('cboVariantList',"<?=base_url()?>");
        load_productlist('cboProductList',"<?=base_url()?>");
        load_report();
        $("#showtablereport").dataTable();
        $("#cboProductList").select2({
            placeholder: "Select product",
            theme: "classic"
        });
        $("#cboVariantList").select2({
            placeholder: "Select variant",
            theme: "classic"
        });
    });
    $('#frmProductVariantMap').submit(function (e) {
        e.preventDefault();
        submitProductVariantMap(this,'btnSubmit','txtid');
        // $("#cboProductList").select();
    });
    function submitProductVariantMap(formid,btnid,txtid) {
        $("#" + btnid).attr('disabled', true);
        $.ajax({
            type: 'post',
            url: formid.action,
            data: new FormData(formid),
            crossDomain: true,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data != false) {
                    console.log(data);
                    var status = "";
                    if (data.status == true) {
                        mytoast(data);
                        // alert("Creation Successful.");
                        load_report();
                        //updateToCreate(btnid);
                        // $("#"+formid.id).trigger('reset');
                    } else if (data.status == false) {
                        // alert(data.data);
                        mytoast(data);
                    }
                    $("#" + txtid).val(0);
                }
            },
            error: function (error) {
                JSON.stringify(error);
                if (error.status == 500) {
                    var str = JSON.stringify(error.responseText);
                    var pos1 = str.indexOf("<p>", str.search("</p>"));
                    var pos = str.indexOf("</p>", pos1);
                    var res = [];
                    res['title'] = "Error";
                    res['message'] = str.slice(pos1, pos);
                } else if (error.status == 404) {
                    var str = JSON.stringify(error.responseText);
                    var pos1 = str.search("<p>");
                    var pos = str.search("</p>");
                    var res = [];
                    res['title'] = "Error";
                    res['message'] = str.slice(pos1, pos);
                }
                mytoast(res);
            }
        });
        $("#" + btnid).attr('disabled', false);
    }
    function load_report() {
        $.ajax({
            type:'post',
            url:"<?=base_url('ProductVariantMap/report_product_variant_map')?>",
            dataType:'json',
            success :function (data) {
                if (data!=false){
                    var htmldata="";
                    var count=1;
                    for (var i in data) {
                        htmldata +="<tr>"+
                            "<td>"+count+"</td>"+
                            "<td>"+data[i].productid+"-"+data[i].product.productname+"</td>"+
                            "<td>"+data[i].variantid+"-"+data[i].variant.variantname+"</td></tr>";
                            // "<td class='text-center' id='action"+data.data.id+"'>" +
                            // "<td class='text-center'></td></tr>" ;
                        // if (data[i].isactive==1){
                        //     htmldata +="<i id='activeInactive"+data[i].id+"' class='fa fa-toggle-on fa-2x' onclick='active_inactive("+data[i].id+",1)'></i>"+"</td></tr>";
                        // }else if (data[i].isactive==0){
                        //     htmldata +="<i class='fa fa-toggle-off fa-2x' onclick='active_inactive("+data[i].id+",0)'></i>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
                        // }
                        count++;
                    }
                    jQuery("#showReportProductVariantMap").html(htmldata);
                }
            }
        })
    }
    function active_inactive(rowid,isactive) {
        active_inactive_records(rowid,isactive,"<?=base_url('Attribute/isactive_attribute')?>");
    }
</script>