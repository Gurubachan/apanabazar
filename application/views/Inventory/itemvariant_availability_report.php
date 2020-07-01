<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style xmlns="" xmlns="" xmlns="">
    #productlist ul{
        list-style: none;
    }
    #productlist ul li{
        display: block;
    }
    #productdetails ul{
        list-style: none;
    }
    #productdetails ul li{
        display: block;
    }
    #datanotfound{
        /*width: 100px;*/
        /*height: 100px;*/
        /*background-color: red;*/
        margin-top: 40%;
        position: absolute;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        font-size: xx-large;
    }
</style>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
            <?php
            foreach ($result as $r) {

                ?>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card"  style="border: 1px solid red; cursor: pointer; min-height: 350px; min-width: 350px;">
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-sm-5">
                                      <img src="<?=base_url('assets/images/ItemImage/'.$r['image'].'.jpg')?>" alt="not found" height="100" width="120">
                                  </div>
                                  <div class="col-sm-7" style="float: right;" id="productlist">
                                      <ul>
                                          <li>Variant ID : <?=$r['id']?></li>
                                          <li>Item Id : <?=$r['itemid']?></li>
                                          <li>Unit Id : <?=$r['unitid']?></li>
                                          <li>Quantity : <?=$r['quantity']?></li>
                                          <li>Mrp : <?=$r['mrp']?></li>
                                          <li>Dimension : <?=$r['dimension']?></li>
                                      </ul>
                                  </div>
                                  <div class="col-sm-12">
                                      <?php
                                      if(isset($itemname)){
                                          ?>
                                          <ul>
                                              <li style="color:red;margin-top: 5px;">Product
                                                  Name: <?= $itemname[0]['itemname'] ?></li>
                                          </ul>
                                          <?php
                                          }
                                          ?>
                                  </div>
                                  <hr style="border: 1px solid gold; width: 100%">
                                  <ul>
                                      <?php
                                      $d = json_decode($r['variantdetails']);
                                      foreach ($d->variantdetails as $vd){
                                          ?>
                                          <li><?=$vd->variantname?> : <?=$vd->variantvalue?></li>
                                          <?php
                                      }
                                      ?>
                                  </ul>
                              </div>
                            </div>
                            <div class="card-footer" id="productdetails" style="border-top 1px solid green">
                                <button type="button" onclick="item_variant(<?=$r['id']?>,<?=$r['mrp']?>)" class="btn btn-block btn-primary"  data-toggle="modal" data-original-title="test" data-target="#modalReport">Details</button>
                                <button type="button" onclick="item_variants_check(<?=$r['id']?>,<?=$r['mrp']?>)" class="btn btn-block btn-success"  data-toggle="modal" data-original-title="test" data-target="#addToInventory">Add To Inventory</button>
                            </div>
                        </div>
                </div>
                <?php
            }
            ?>
    </div>
</div>
<script>
    var itemvariantid =0;
    load_trackby("cboTrackById","<?=base_url('')?>");
    load_vendor("cboVendorId","<?=base_url('')?>");
    function item_variant(id,mrp) {
        itemvariantid=id;
        $.ajax({
            type:'post',
            url:'<?=base_url("Inventory/check_inventory_details")?>',
            data:{itemvariantid:id},
            dataType:'json',
            success:function (f) {
                // console.log(f);
               if(f.status !=false){
                var htmldata ="";
                var j = 0;
                for(var i in f){
                    j++;
                    <?php
                    if($this->session->adminLogin['usertype']=="Admin"){
                        ?>
                    htmldata+="<tr> <td>"+j+"</td><td>"+f[i].vendor.vendorname+"</td><td>"+f[i].itemid+"</td><td>"+mrp+"</td><td>"+f[i].saleprice+"</td><td>"+f[i].discount+" %</td><td>"+f[i].openingstock+"</td><td>"+f[i].trackbyid.track+"</td></tr>";
                    <?php
                    }else{
                     ?>
                    htmldata+="<tr> <td>"+j+"</td><td>"+f[i].itemid+"</td><td>"+mrp+"</td><td>"+f[i].saleprice+"</td><td>"+f[i].discount+" %</td><td>"+f[i].openingstock+"</td><td>"+f[i].trackbyid.track+"</td></tr>";
                <?php
                }
                    ?>

                }
               }else{
                   var htmldata ="<div class='row'>" +
                       "<div class='p-5' id='datanotfound'>" +
                       "<div class='ml-auto mr-auto d-block'>" +
                       "<div class='text-center text-uppercase f-w-700'>Data Not Found</div>" +
                       "</div></div></div>";
               }
                $("#load_item_variant_id_details").html(htmldata);
            }
        });
    }

    function item_variants_check(id, mrp) {
        var vendorid = $("#cboVendorId").val();
        <?php
     if($this->session->adminLogin['usertype']=="Vendor"){
         ?>
         $.ajax({
             type:'post',
             url:'<?=base_url("Inventory/check_vendor_wise_inventory_data")?>',
             data:{vendorid:vendorid,itemid:id},
             dataType:'json',
             success:function (f) {
                 if(f.status!=false){
                     // mytoast(data);
                     $("#btnSubmit").html("Update");
                     console.log(f);
                     $("#txtid").val(f[0].id);
                     $("#txtSalePrice").val(f[0].saleprice);
                     $("#txtDiscount").val(f[0].discount);
                     $("#txtOpeningStock").val(f[0].openingstock);
                     $("#cboTrackById").val(f[0].trackby);
                 }
             }
         });
         <?php
          }
        ?>
    }

</script>
<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Inventory Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Report</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel"  style="min-height: 400px;max-height: 400px;">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <?php
                                    if($this->session->adminLogin['usertype']=="Admin"){
                                    ?>
                                        <th>Vendor</th>
                                    <?php
                                    }
                                    ?>
                                    <th>Itemid</th>
                                    <th>MRP</th>
                                    <th>Sales Price</th>
                                    <th>Discount</th>
                                    <th>Opening Stock</th>
                                    <th>Trackby</th>
                                </tr>
                                </thead>
                                <tbody id="load_item_variant_id_details"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary f-right mr-3" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addToInventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Inventory Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form id="frmInventorycreate">
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab">Add Inventory</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-3" role="tabpanel"  style="min-height: 400px;max-height: 400px;">
                            <div class="row product-adding">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card-body">
                                                    <div class="digital-add needs-validation">
                                                        <input type="hidden" id="txtid" name="txtid" value="0">
                                                        <?php
                                                        if($this->session->adminLogin['usertype'] == "Vendor"){
                                                            $vendorid = $this->session->adminLogin['userid'];
                                                            $vendorname = $this->session->adminLogin['name'];
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="col-form-label"><span>*</span> Vendor Name</label>
                                                                <select class="custom-select" id="cboVendorId" name="cboVendorId" required>
                                                                    <option value="<?=$vendorid?>"><?=$vendorname?></option>
                                                                </select>
                                                            </div>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="col-form-label"><span>*</span> Vendor Name</label>
                                                                <select class="custom-select" id="cboVendorId" name="cboVendorId" required>
                                                                </select>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Sale Price</label>
                                                            <input class="form-control" id="txtSalePrice" name="txtSalePrice" type="text" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Discount</label>
                                                            <input class="form-control" id="txtDiscount" name="txtDiscount" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card-body">
                                                    <div class="digital-add needs-validation">
<!--                                                        <div class="form-group">-->
<!--                                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Inward Stock</label>-->
<!--                                                            <input class="form-control" id="txtInwardStock" name="txtInwardStock" type="text" required>-->
<!--                                                        </div>-->
<!--                                                        <div class="form-group">-->
<!--                                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Outward Stock</label>-->
<!--                                                            <input class="form-control" id="txtOutwardStock" name="txtOutwardStock" type="text" required>-->
<!--                                                        </div>-->
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Opening Stock</label>
                                                            <input class="form-control" id="txtOpeningStock" name="txtOpeningStock" type="text" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label"><span>*</span> Track By</label>
                                                            <select class="custom-select" id="cboTrackById" name="cboTrackById" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xl-12" style="text-align: center">
                    <button type="reset"  class="btn btn-danger f-left" id="btnReset">Reset</button>
                    <button type="submit" class="btn btn-success f-right p-2" id="btnSubmit">Add</button>
                    <button type="button"  class="btn btn-primary f-right mr-3" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#cboVendorId").change(function () {
        var vendorid = $("#cboVendorId").val();
      <?php
        if($this->session->adminLogin['usertype']=="Admin"){
            ?>
        $.ajax({
            type:'post',
            url:'<?=base_url("Inventory/check_vendor_wise_inventory_data")?>',
            data:{vendorid:vendorid,itemid:itemvariantid},
            dataType:'json',
            success:function (f) {
                console.log(f);
                if(f.status!=false){
                    $("#btnSubmit").html("Update");
                    $("#txtid").val(f[0].id);
                    $("#txtSalePrice").val(f[0].saleprice);
                    $("#txtDiscount").val(f[0].discount);
                    $("#txtOpeningStock").val(f[0].openingstock);
                    $("#cboTrackById").val(f[0].trackby);
                }else{
                    $("#btnSubmit").html("Add Inventory");
                    $("#txtid").val(0);
                    $("#txtSalePrice").val("");
                    $("#txtDiscount").val("");
                    $("#txtOpeningStock").val("");
                    $("#cboTrackById").val("");
                }
            }
        });
        <?php
        }
        ?>
    });
    $("#frmInventorycreate").submit(function (e) {
        e.preventDefault();
        // let frm = $("#frmInventorycreate").serialize() + '&' + $.param({cboItemId:itemvariantid,txtid:textid});
        let frm = $("#frmInventorycreate").serialize() + '&' + $.param({cboItemId:itemvariantid});
        $.ajax({
            type:'post',
            url:'<?=base_url("Inventory/inventory_creation")?>',
            data:frm,
            dataType:'json',
            success:function (data) {
                if(data.status!=false){
                    mytoast(data);
                    $('#addToInventory').modal('hide');
                    $("#frmInventorycreate").trigger('reset');
                }
            }
        });
    });
</script>
