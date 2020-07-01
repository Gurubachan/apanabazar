<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="digital-add needs-validation">
                    <input type="hidden" id="txtid" name="txtid" value="0">
                    <div class="form-group">
                        <label for="validationCustom01" class="col-form-label"><span>*</span> Maximum Retail Price</label>
                        <input class="form-control" id="txtMrp" name="txtMrp" type="text" required placeholder="e.g 110">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="digital-add needs-validation">
                    <div class="form-group">
                        <label class="col-form-label"><span>*</span> Unit</label>
                        <select class="custom-select form-control" id="CboUnitId" name="CboUnitId" required >
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="digital-add needs-validation">
                    <div class="form-group">
                        <label for="validationCustom01" class="col-form-label"><span>*</span> Quantity</label>
                        <input class="form-control" id="txtQuantity" name="txtQuantity" type="text" required placeholder="e.g 10">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="digital-add needs-validation">
                    <div class="form-group">
                        <label for="validationCustom01" class="col-form-label"><span>*</span>Dimension</label>
                        <input class="form-control" id="txtDimension" name="txtDimension" type="text" placeholder="e.g 5X5X5">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="digital-add needs-validation">
                    <div class="form-group">
                        <label for="validationCustom01" class="col-form-label"><span>*</span>Image</label>
                        <input type="file" class="form-control" id="fileImage" name="fileImage"  required>
                    </div>
                </div>
            </div>
        </div>
        <div id="loadItemVariantResponse"></div>
        <div class="row product-adding">
            <div class="col-xl-12">
                <button type="reset"  class="btn btn-danger f-left" id="btnReset">Reset</button> &nbsp;
<!--                <button type="button" class="btn btn-success f-let" id="btnReport" onclick="load_variant_report()">Report</button>-->
                <button type="submit" class="btn btn-primary f-right" id="btnSubmit">Add</button>
            </div>
        </div>

    </div>
</div>
<!--<div class="card">-->
<!--    <div class="card-body">-->
<!--       <div class="table-response">-->
<!--           <table class="table table-bordered">-->
<!--               <thead>-->
<!--               <tr>-->
<!--                   <th>Sl#</th>-->
<!--                   <th>Itemid</th>-->
<!--                   <th>Variant Details</th>-->
<!--                   <th>Unitid</th>-->
<!--                   <th>Quantity</th>-->
<!--                   <th>Mrp</th>-->
<!--                   <th>Dimension</th>-->
<!--                   <th>Image</th>-->
<!--               </tr>-->
<!--               </thead>-->
<!--               <tbody id="load_variant_data">-->
<!---->
<!--               </tbody>-->
<!--           </table>-->
<!--       </div>-->
<!--    </div>-->
<!--</div>-->

<script>
    load_unit('CboUnitId',"<?=base_url()?>");
    $.ajax({
        type:'post',
        url:'<?=base_url("Item/findVariantType")?>',
        data:{itemid:itemsid},
        dataType:'json',
        success:function (f) {
            if(f != false){
               var htmldata="";
                for(var i in f){
                    htmldata+="   <div class=\"row\">\n" +
                        "                                                        <div class=\"col-sm-12\">\n" +
                        "                                                            <div class=\"digital-add needs-validation\">\n" +
                        "                                                                <div class=\"form-group\">\n" +
                        "                                                                    <label for=\"validationCustom01\" class=\"col-form-label\"><span>*</span>"+f[i].variantname+"</label>\n" +
                        "                                                                    <input type=\"hidden\" class=\"form-control\" id=\"txtVariantID"+f[i].id+"\" name=\"txtVariantID[]\" value='"+f[i].id+"'>\n" +
                        "                                                                    <input type=\"hidden\" class=\"form-control\" id=\"txtVariantName"+f[i].id+"\" name=\"txtVariantName[]\" value='"+f[i].variantname+"'>\n" +
                        "                                                                    <input type=\"text\" class=\"form-control\" id=\"txtVariantDetails"+f[i].id+"\" name=\"txtVariantDetails[]\"  required placeholder='Enter&nbsp;"+f[i].variantname+"'>\n" +
                        "                                                                </div>\n" +
                        "                                                            </div>\n" +
                        "                                                        </div>\n" +
                        "                                                    </div>";
                }
                $('#loadItemVariantResponse').html(htmldata);
            }else{
                $('#loadItemVariantResponse').css({'color':'red','text-align':'center'}).html("No variant type mapped yet. <a href='<?=base_url("ProductVariantMap/")?>'>Map?</a>");
                // $("#btnSubmit").prop('disabled',true);
            }
        }
    });
//function load_variant_report() {
//   $.ajax({
//       type:'post',
//       url:'<?//=base_url("Itemvariant/report_itemvariant")?>//',
//       // data:{itemid:itemsid},
//       dataType:'json',
//       success:function (f) {
//           console.log(f);
//           var htmldata="";
//           var k=0;
//           for(var i in f){
//               k++;
//                   // htmldata+="<tr><td>"+i+"</td><td>"+f.data.id+"</td></tr>";
//                   htmldata += "<tr><td>" + k + "</td><td>" + f.data.id + "</td></tr>";
//
//           }
//           $("#load_variant_data").html(htmldata);
//       }
//   });
//}
</script>
